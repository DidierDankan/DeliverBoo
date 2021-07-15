<template>
  <div v-if="restaurant.name">
    <div class="detail container">

      <div class="image">
        <img v-show="restaurant.cover" :src="`http://127.0.0.1:8000/storage/restaurants-covers/${restaurant.cover}`" :alt="restaurant.name">
      </div>

      <div class="info">
        <h1>{{ restaurant.name }}</h1>
        <div><span v-for="(type, index) in restaurant.types" :key="index">{{ type.type }} ° </span></div>
        <div>
          <span>{{ restaurant.address }}, </span>
          <span>{{ restaurant.city }}, </span>
          <span>{{ restaurant.zip_code }}</span>
        </div>
      </div>
    </div>

    <div class="foods">
      <div class="container">
        <h1>Cibi</h1>
        <div class="flex">
          <div class="cards">
            <div class="card" :class="{ notAvailable: !food.visibility }" v-for="(food, index) in foods" :key="index">
              <div class="mb">{{ food.title }}</div>
              <div class="text-color mb" v-if="food.visibility === 0">Non Disponibile</div>
              <div class="text-color mb overflow" v-else>{{ food.description }}</div>
              <div class="text-color mb">{{ food.price.toFixed(2) }} €</div>
              <a class="btn" href="" v-show="food.visibility">Aggiungi</a>
            </div>
          </div>
          <div class="cart">
            <a class="btn btn-cart" href="">Vai alla cassa</a>
            <div>Il tuo carrello è vuoto</div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <Loader v-else/>
</template>

<script>
import axios from "axios";
import Loader from './components/Loader.vue';

export default {
  name: "RestaurantDetail",
  components: {
    Loader,
  },
  data() {
    return {
      restaurant: [],
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
          this.restaurant = res.data[0];
          this.foods = res.data[1];
          console.log(res.data[0]);
          //   console.log(this.restaurantDetail);
        });
    },
  },
};
</script>

<style lang="scss" scoped>
.image img {
  width: 100%;
}

.info {
  margin-left: 1rem;
}

.foods {
  background: #f4f5f5;
  margin-top: 100px;

  h1 {
    padding: 1rem;
  }

  .card {
    padding: 1rem;
    background-color: #fff;
    border: 1px solid #e8ebeb;
    cursor: pointer;

    .text-color {
      color: #adafaf;
    }

    .mb {
      margin-bottom: 10px;
    }

    .btn {
      font-size: 10px;
    }
  }

  .cart {
    display: none;
  }

  .notAvailable {
    background-color: #f8f9f9;
    cursor: not-allowed;
  }
}

.btn {
  color: #fff;
  background: #00ccbc;
  padding: 10px;
  border-radius: 5px;
  text-decoration: none;
}

@media screen and (min-width: 768px) {
  .detail {
    display: flex;
    justify-content: space-between;
    align-content: center;
    flex-direction: row-reverse;
    
    .image {
      width: 480px;
      height: 260px;
      overflow: hidden;
      margin-right: 1rem;

      img {
        object-fit: cover;
        object-position: center;
      }
    }
  }

  .flex {
    display: flex;
    justify-content: space-around;
    margin: 0 1rem;

    .cards {
      display: flex;
      flex-wrap: wrap;
      flex-basis: 80%;

      .card {
        flex-basis: calc(100% / 2 - 60px);
        margin: 10px;
        border-radius: 5px;
        position: relative;

        .btn {
          position: absolute;
          right: 10px;
          bottom: 10px;
        }
      }
    }

    .cart {
      display: block;
      width: 300px;
      background: #fff;
      display: flex;
      flex-direction: column;
      text-align: center;
      position: relative;
      right: 0;
      top: -90px;
      border-radius: 5px;
      border: 1px solid #e8ebeb;
      height: max-content;

      .btn-cart {
        margin: 10px;
      }

      div {
        margin: 50px 0;
      }
    }
  }
  .overflow {
    height: 60px;
    overflow: hidden;
  }
}

@media screen and (min-width: 1170px) {
  .detail.container {
    max-width: 1170px;
    margin: 0 auto 100px;
  }

  .foods {
    .container {
      max-width: 1170px;
      margin: 0 auto;
    }
  }
}
</style>
