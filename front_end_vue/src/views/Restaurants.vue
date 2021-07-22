<template>
  <div class="restaurants">
    <Hero />

    <Type :key="reRender" @click="getRestaurants()" />

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
                <span>
                  {{ restaurant.types }}
                </span>
              </div>
              <router-link
                @click="cleanLocalTypes(restaurant.id)"
                class="link"
                :to="{
                  name: 'restaurant-detail',
                  params: { id: restaurant.id },
                }"
              >
              </router-link>
            </div>
          </div>

          <Loader v-else />

          <section v-show="sectionNexPrevVisibility()" class="naviga">
            <div
              class="btn-navi"
              v-for="i in pages.last"
              :key="`page${i}`"
              @click="getRestaurants(i)"
            >
              <div :class="{ 'active-page': i == pages.current }"></div>
            </div>
          </section>

          <!-- Loading... -->
        </div>
        <div v-else class="message">
          Ci dispiace non ci sono ristoranti corrispondenti alla tua ricerca...

          <!-- <Loader /> -->
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
import Loader from "./components/Loader.vue";
import Type from "./components/Type.vue";
import Workers from "./components/Workers.vue";
import Footer from "./components/Footer.vue";

export default {
  name: "Restaurants",

  components: {
    Hero,
    Loader,
    Type,
    Workers,
    Footer,
  },

  data() {
    return {
      restaurants: [],
      pages: [],
      reRender: 0,
      filterLocal: [],
      clientToken: "",
    };
  },

  created() {
    this.setFilterCache();
    this.getRestaurants();
    // this.getClientToken();
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
    reRenderTypes() {
      this.reRender += 1;
    },
    cleanLocalTypes(restaurant_id) {
      localStorage.setItem("checkedTypes", JSON.stringify([]));
      this.resetBasket(restaurant_id);
    },
    setFilterCache() {
      this.filterLocal = localStorage.getItem("checkedTypes");
    },
    sectionNexPrevVisibility() {
      return localStorage.getItem("checkedTypes") == "[]" ? true : false;
    },
    getClientToken() {
      axios.get("http://127.0.0.1:8000/api/orders/generate").then((res) => {
        this.clientToken = res.data.token;
        console.log(res.data.token);
      });

      setTimeout(this.paymentToken, 10000);
    },

    paymentToken() {
      if (!localStorage.getItem("clienttoken")) {
        localStorage.setItem("clienttoken", JSON.stringify(""));
      }
      let clientToken = JSON.parse(localStorage.getItem("clienttoken"));

      if (clientToken != this.clientToken) {
        clientToken = this.clientToken;
      }

      localStorage.setItem("clienttoken", JSON.stringify(clientToken));
      console.log(localStorage.getItem("clienttoken"));
    },

    resetBasket(restaurant_id) {
      const cart = JSON.parse(localStorage.getItem("cart"));

      if (cart[0] && cart[0].restaurant_id != restaurant_id) {
        let reset = confirm(
          "attenzione non puoi ordinare da 2 ristoranti diversi.\nVuoi svuotare il carrello?"
        );
        reset === true
          ? localStorage.setItem("cart", JSON.stringify([]))
          : (location.href = "http://localhost:8080/#/");
      }
    },
  },
};
</script>

<style lang="scss">
@import "@/style/restaurants.scss";
</style>
