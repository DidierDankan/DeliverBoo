<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Food;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;



class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $foods = Food::all();
        
        
        
        // $restaurant = Restaurant::find($restaurant_id);
        return view('admin.foods.index', compact('foods'));
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $user_id = Auth::user()->id;

        $restaurants = Restaurant::where('user_id', '=', $user_id)->get();

        return view('admin.foods.create', compact('restaurants'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'title' => ['required', 'max:100'],
            'price' => ['required','numeric'],
            'description' => ['nullable',],
            'type' => ['required', 'max:50'],
            'ingredients' => ['required', 'max:255'],
            'visibility' => ['boolean'],
            'restaurant_id' => ['nullable','exists:restaurants,id'],

        ], 
        [
            // custom message 
            'required'=>'The :attribute is required',
            'max'=> 'Max :max characters allowed for the :attribute',
        ]);
                
         $data = $request->all();

        // dd($data);

        //create and save record on db 
        $new_food = new Food();

        $new_food->fill($data); // FILLABLE
        $new_food->save();

        //salva relazione con tags in poivot 
        // if (array_key_exists('orders', $data)) {

        //     $new_food->tags()->attach($data['orders']); //aggiunge nuvi records nella tabella pivot
        // }

        return redirect()->route('admin.foods.show', $new_food->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $user_id = Auth::user()->id;

        $restaurants = Restaurant::where('user_id', '=', $user_id)->get();

        $restaurants_id = [];

        
        foreach ($restaurants as $restaurant){
            
            array_push($restaurants_id, $restaurant->id);
            
        }
        

        $food = Food::find($id);

        if (! $food || !in_array($food->restaurant_id, $restaurants_id)) {
            return view('admin.errors.404error');
        }

        return view('admin.foods.show', compact('food'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user_id = Auth::user()->id;

        $restaurants = Restaurant::where('user_id', '=', $user_id)->get();

        $restaurants_id = [];

        
        foreach ($restaurants as $restaurant){
            
            array_push($restaurants_id, $restaurant->id);
            
        }
        

        $food = Food::find($id);

        if (! $food || !in_array($food->restaurant_id, $restaurants_id)) {
            return view('admin.errors.404error');
        }

        $types = ['Food','Drink','Souce'];

        return view('admin.foods.edit', compact('food', 'types') );
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'title' => ['required', 'max:100'],
            'price' => ['required','numeric'],
            'description' => ['nullable',],
            'type' => ['required', 'max:50'],
            'ingredients' => ['required', 'max:255'],
            'visibility' => ['boolean'],
            'restaurant_id' => ['nullable','exists:restaurants,id'],

        ], 
        [
            // custom message 
            'required'=>'The :attribute is required',
            'max'=> 'Max :max characters allowed for the :attribute',
        ]);


        $data = $request->all();
        $food = Food::find($id);

        $food->update($data); //fillable

        // Aggiorna relazione tabella pivot
        if (array_key_exists('orders', $data)) {
            //aggiungere recor tabella pivot 
            $food->orders()->sync($data['orders']);
        } else {
            $food->orders()->detach();
        }
        
        return redirect()->route('admin.foods.show', $food->id);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $food = Food::find($id);

        // pulizia record orfani da tabella pivot
        $food->orders()->detach();

        // rimozione
        $food->delete();
        
        return redirect()->route('admin.restaurants.show', $food->restaurant_id)->with('deleted', $food->title);

    }
}
