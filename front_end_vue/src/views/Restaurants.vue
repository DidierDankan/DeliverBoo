<template>
  <div class="restaurants">
    <Hero />

    <Type />
    <div class="bg-container">
      <div class="main-container">
        <h1>I tuoi piatti preferiti, consegnati da noi.</h1>
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

            <h3 class="restaurant-title">
              {{ restaurant.name }}
            </h3>

            <router-link
              class="link"
              :to="{
                name: 'restaurant-detail',
                params: { id: restaurant.id },
              }"
            >
            </router-link>
          </div>
        </div>

        <!-- Loading... -->
        <Loader v-else />

        <section class="naviga">
          <!-- <button
          v-show="pages.current > 1"
          @click="getRestaurants(pages.current - 1)"
        >
          prev
        </button> -->
          <div
            class="btn-navi"
            v-for="i in pages.last"
            :key="`page${i}`"
            @click="getRestaurants(i)"
          >
            <!-- {{ i }} -->
            <div :class="{ 'active-page': i == pages.current }"></div>
          </div>
          <!-- <button
          v-show="pages.current < pages.last"
          @click="getRestaurants(pages.current + 1)"
        >
          next
        </button> -->
        </section>
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
      restaurants: null,
      pages: [],
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
.bg-container {
  background: #ffeae4;
}
.main-container {
  max-width: 1170px;
  margin: 0 auto;
  padding: 40px 0px 40px 0px;
  h1 {
    margin-bottom: 20px;
    text-align: center;
    color: #2e3333;
  }
}
.cards {
  display: grid;
  grid-template-columns: 6fr;
  row-gap: 15px;
  .card {
    width: 100%;
    position: relative;
    margin-bottom: 5px;
    background: #00ccbc;
    cursor: pointer;
    transition: transform 0.4s;
    box-shadow: 0 10px 6px -6px rgba(119, 119, 119, 0.3);
    &:hover {
      transform: scale(1.05);
    }
    img {
      width: 100%;
      height: 150px;
      object-fit: cover;
      object-position: top;
    }
    .restaurant-title {
      text-align: left;
      color: #f4ffff;
      font-weight: 600;
      margin-left: 5px;
      padding: 5px;
    }
  }
}
.link {
  width: 100%;
  height: 100%;
  display: inline-block;
  position: absolute;
  top: 0;
  right: 0;
  left: 0;
  bottom: 0;
}

.naviga {
  display: flex;
  justify-content: center;
  align-items: center;
  text-align: center;
  padding: 15px;
  .btn-navi {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 20px;
    height: 20px;
    margin: 5px;
    border-radius: 50%;
    border: 2px solid #00ccbc;
    cursor: pointer;
    .active-page {
      width: 10px;
      height: 10px;
      border-radius: 50%;
      background: #00ccbc;
    }
  }
}

//break points
@media screen and (min-width: 768px) {
  .cards {
    width: 90%;
    margin: 0 auto;
    grid-template-columns: 5fr 5fr;
    column-gap: 10px;
    row-gap: 15px;
  }
}
@media screen and (min-width: 1170px) {
  .cards {
    width: 85%;
    margin: 0 auto;
    grid-template-columns: 5fr 5fr 5fr;
    column-gap: 10px;
    row-gap: 15px;
  }
}
</style>
