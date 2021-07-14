<template>
  <div>
    <p>{{ restaurantDetail.name }}</p>
    <div>
      <ul v-for="(type, index) in restaurantDetail.types" :key="index">
        <li>
          {{ type.type }}
        </li>
      </ul>
    </div>
    <hr />
    <div>
      <ul v-for="(food, index) in foods" :key="index">
        <li>
          {{ food.title }}
        </li>
        <li>
          {{ food.price }}
        </li>
        <li>
          {{ food.ingredients }}
        </li>
        <li>
          {{ food.type }}
        </li>
        <li>
          {{ food.visibility }}
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  name: "RestaurantDetail",

  data() {
    return {
      restaurantDetail: [],
      foods: [],
    };
  },
  created() {
    this.getRestaurant();
  },

  methods: {
    getRestaurant() {
      axios
        .get(`http://127.0.0.1:8000/api/restaurants/${this.$route.params.id}`)
        .then((res) => {
          //   const restaurantDetail = Object.assign({}, res.data);
          this.restaurantDetail = res.data[0];
          this.foods = res.data[1];
          console.log(res.data);
          //   console.log(this.restaurantDetail);
        });
    },
  },
};
</script>

<style></style>
