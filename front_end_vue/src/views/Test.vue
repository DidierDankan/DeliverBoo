<template>
  <div class="about">
    <h1>This is an test page</h1>
    <div>
      <ul v-for="restaurant in restaurants" :key="restaurant.id">
        <li>
          {{ restaurant.name }}
        </li>
        <li>
          {{ restaurant.address }}
        </li>
        <li>
          {{ restaurant.city }}
        </li>
        <router-link
          :to="{ name: 'restaurant-detail', params: { id: restaurant.id } }"
        >
          View
        </router-link>
      </ul>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  name: "Test",

  data() {
    return {
      restaurants: [],
      //   Index = 0,
    };
  },
  created() {
    this.getRestaurants();
  },
  methods: {
    getRestaurants() {
      axios
        .get("http://127.0.0.1:8000/api/restaurants")
        .then((res) => {
          this.restaurants = res.data;
          console.log(res.data);
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
};
</script>

<style></style>
