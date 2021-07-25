<template>
  <div class="restaurants">
    <Hero />

    <Type @click="getRestaurants()" />

    <div class="bg-container">
      <div class="main-container">
        <h1>I tuoi piatti preferiti, consegnati da noi.</h1>
        <div v-if="restaurants.length > 0" class="results">
          <div class="cards" v-if="restaurants">
            <div
              class="card"
              v-for="restaurant in restaurants"
              :key="restaurant.id"
            >
              <img
                v-if="restaurant.cover"
                :src="
                  `http://127.0.0.1:8000/storage/restaurants-covers/${restaurant.cover}`
                "
                :alt="restaurant.name"
              />
              <img
                v-else
                src="https://consumer-component-library.roocdn.com/23.0.0/static/images/placeholder.svg"
                :alt="restaurant.name"
              />
              <div class="name-type">
                <h3 class="restaurant-title">
                  {{ restaurant.name }}
                </h3>
                <div class="margin-badge">
                  <span
                    class="badge-type"
                    v-for="type in restaurant.types"
                    :key="type.id"
                  >
                    {{ type.type }}
                  </span>
                </div>
              </div>
              <router-link
                @click="cleanLocalTypes()"
                class="link"
                :to="{
                  name: 'restaurant-detail',
                  params: { id: restaurant.id },
                }"
              >
              </router-link>
            </div>
          </div>
          <section v-if="sectionNexPrevVisibility()" class="naviga">
            <div
              class="btn-navi"
              v-for="i in pages.last"
              :key="`page${i}`"
              @click="getRestaurants(i)"
            >
              <div :class="{ 'active-page': i == pages.current }"></div>
            </div>
          </section>
        </div>
        <div v-else class="message">
          Ci dispiace non ci sono ristoranti corrispondenti alla tua ricerca...
        </div>
      </div>
    </div>

    <Workers />

    <Footer />
  </div>
</template>

<script>
import axios from "axios";
import Hero from "./components/Hero.vue";
import Type from "./components/Type.vue";
import Workers from "./components/Workers.vue";
import Footer from "./components/Footer.vue";

export default {
  name: "Restaurants",

  components: {
    Hero,
    Type,
    Workers,
    Footer,
  },

  data() {
    return {
      restaurants: [],
      pages: [],
      filterLocal: [],
    };
  },

  created() {
    this.setFilterCache();
    this.getRestaurants();
  },

  methods: {
    getRestaurants(page = 1) {
      if (localStorage.getItem("checkedTypes") == "[]") {
        axios
          .get(`http://127.0.0.1:8000/api/restaurants?page=${page}`)
          .then((res) => {
            this.restaurants = res.data.data;
            this.pages = {
              current: res.data.current_page,
              last: res.data.last_page,
            };
          })
          .catch((err) => {
            console.log(err);
          });
      } else {
        axios
          .get(`http://127.0.0.1:8000/api/filter`, {
            params: {
              list: localStorage.getItem("checkedTypes"),
            },
          })
          .then((res) => {
            this.restaurants = res.data;
          })
          .catch((err) => {
            console.log(err);
          });
      }
    },
    cleanLocalTypes() {
      localStorage.setItem("checkedTypes", JSON.stringify([]));
    },
    setFilterCache() {
      this.filterLocal = localStorage.getItem("checkedTypes");
    },
    sectionNexPrevVisibility() {
      return localStorage.getItem("checkedTypes") == "[]" ? true : false;
    },
  },
};
</script>

<style lang="scss" scoped>
@import "@/style/restaurants.scss";
</style>
