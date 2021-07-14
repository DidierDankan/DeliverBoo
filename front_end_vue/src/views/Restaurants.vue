<template>
  <div class="about">
    <h1>I tuoi piatti preferiti, consegnati da noi.</h1>
    <div class="main-container">
      <div class="cards" v-if="restaurants">
        <div
          class="card"
          v-for="restaurant in restaurants"
          :key="restaurant.id"
        >
          <div class="cover">
            <img
              v-if="restaurant.cover"
              :src="
                `http://127.0.0.1:8000/storage/restaurants-covers/${restaurant.cover}`
              "
              :alt="restaurant.name"
            />
          </div>

          <h3 class="restaurant-title">
            {{ restaurant.name }}
          </h3>
          <p>
            {{ restaurant.address }}
          </p>

          <div class="layer">
            <router-link
              :to="{ name: 'restaurant-detail', params: { id: restaurant.id } }"
            >
              Visit
            </router-link>
          </div>
        </div>
      </div>

      <div v-else>
        Loading...
      </div>

      <section class="navigation">
        <button
          v-show="pages.current > 1"
          @click="getRestaurants(pages.current - 1)"
        >
          prev
        </button>
        <button
          v-for="i in pages.last"
          :key="`page${i}`"
          @click="getRestaurants(i)"
          :class="{ 'active-page': i == pages.current }"
        >
          {{ i }}
        </button>
        <button
          v-show="pages.current < pages.last"
          @click="getRestaurants(pages.current + 1)"
        >
          next
        </button>
      </section>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  name: "Restaurants",

  data() {
    return {
      restaurants: null,
      pages: [],
      // image: `http://127.0.0.1:8000/storage/restaurants-covers/${restaurant.cover}`,
    };
  },
  created() {
    this.getRestaurants();
  },
  methods: {
    getRestaurants(page = 1) {
      axios
        .get(`http://127.0.0.1:8000/api/restaurants?page=${page}`)
        .then((res) => {
          this.restaurants = res.data.data;
          console.log(res.data.data);
          this.pages = {
            current: res.data.current_page,
            last: res.data.last_page,
          };
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
};
</script>

<style lang="scss">
.main-container {
  width: 100%;
  background: #ffeae4;
}
.cards {
  display: grid;
  grid-template-columns: 6fr;
  // margin: 5px;
  .card {
    width: 100%;
    position: relative;
    margin: 5px;
    cursor: pointer;
    transition: all 1s;
    &:hover .layer {
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .cover img {
      max-width: 100%;
      border-radius: 5px;
    }
    .restaurant-title {
      color: #2e3333;
    }
    .layer {
      position: absolute;
      left: 0;
      right: 0;
      top: 0;
      bottom: 0;
      display: none;
      background: rgba(209, 196, 196, 0.48);
      border: 1px solid rgb(221, 203, 203);
      border-radius: 5px;
    }
  }
}
.navigation {
  .active-page {
    background: orange;
  }
}
</style>
