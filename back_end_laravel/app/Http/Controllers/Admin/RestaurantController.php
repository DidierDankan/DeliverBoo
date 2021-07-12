<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Food;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Auth;

use App\Models\Type;


class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $user_id = Auth::user()->id;

        $types = Type::all();


        $restaurants = Restaurant::where('user_id', '=', $user_id)->paginate(6);

        return view('admin.restaurants.index', compact('restaurants', 'types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $types = Type::all();
        return view('admin.restaurants.create', compact('types'));
        // return 'peppino';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)

    {   


        if ($request->hasFile('cover')) { // depends on your FormRequest validation if `file` field is required or not
            $path = $request->cover->storePublicly('');
        }
    
        // Restaurant::create(array_merge($request->except('cover'), ['cover' => $path]));


        $data = $request->all();

        // dd($data);

        $new_restaurant = new Restaurant();

        $new_restaurant->fill($data);

        $new_restaurant->user_id = Auth::user()->id;

        $new_restaurant->cover = $path;

        $new_restaurant->save();

        if(array_key_exists('types', $data)){
            $new_restaurant->types()->attach($data['types']);
        }

        if(array_key_exists('cover', $data)) {
            $img_path = Storage::put('public/restaurants-covers/', $data['cover']);

            $data['cover'] = $img_path;
        }


        
        


        return redirect()->route('admin.restaurants.show', $new_restaurant->id)->with('created', $new_restaurant->name);


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

        $restaurant = Restaurant::where('user_id', '=', $user_id)->find($id);

        // dd($restaurant);

        $foods = Food::where('restaurant_id', '=', $id)->paginate(4);

        $types = Type::all();



        if (!$restaurant) {
            abort(404);
        }

        return view('admin.restaurants.show', compact('restaurant', 'foods', 'types'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $restaurant = Restaurant::find($id);
        $types = Type::all();

        if (!$restaurant) {
            abort(404);
        }
        return view('admin.restaurants.edit', compact('restaurant', 'types'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $restaurant = Restaurant::find($id);

        $restaurant->delete();

        return redirect()->route('admin.restaurants.index')->with('deleted', $restaurant->name);

    }
}
