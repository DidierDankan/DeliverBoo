<template>
  <div v-if="restaurant.name">
    <div class="detail container">
      <div class="image">
        <img
          v-show="restaurant.cover"
          :src="
            `http://127.0.0.1:8000/storage/restaurants-covers/${restaurant.cover}`
          "
          :alt="restaurant.name"
        />
      </div>

      <div class="info">
        <h1>{{ restaurant.name }}</h1>
        <div>
          <span v-for="(type, index) in restaurant.types" :key="index"
            >{{ type.type }} °
          </span>
        </div>
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
            <div
              class="card"
              :class="{ notAvailable: !food.visibility }"
              v-for="(food, index) in items"
              :key="index"
              @click="modalVisibilityShow(food.id)"
            >
              <div class="mb">{{ food.title }}</div>
              <div class="text-color mb" v-if="food.visibility === 0">
                Non Disponibile
              </div>
              <div class="text-color mb overflow" v-else>
                {{ food.description }}
              </div>
              <div class="text-color mb">{{ food.price.toFixed(2) }} €</div>
              <!-- <a class="btn" href="" v-show="food.visibility">Aggiungi</a> -->

              <!-- <a
                class="btn"
                @click="removeFromCart(food.id)"
                v-if="isInCart(food.id)"
                >Rimuovi</a
              >
              <a
                class="btn"
                v-show="food.visibility"
                @click="addToCart(food.id)"
                v-else
                >Aggiungi</a
              > -->

              <AddBtn
                v-show="food.visibility"
                @click="forceRerender()"
                :key="componentKey"
                :items="items"
                :food="food"
              />
            </div>
          </div>
          <div class="cart">
            <!-- <a class="btn btn-cart" @click.prevent="resetBasket()" href=""
              >Vai alla cassa</a
            > -->
            <Cart @click="forceRerender()" :key="componentKey" />
            <!-- <div>Il tuo carrello è vuoto</div> -->
          </div>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div
      class="modal"
      v-show="food.id == foodId ? true : false"
      v-for="(food, index) in items"
      :key="index"
    >
      <div class="title">
        <h3>{{ food.title }}</h3>
      </div>
      <div class="info-modal">
        <div class="mb-2">
          <span><strong>Descrizione: </strong></span>{{ food.description }}
        </div>
        <div>
          <span><strong>Ingredienti: </strong></span>{{ food.ingredients }}
        </div>
      </div>
      <div class="button">
        <a class="btn btn-cart left" href="">Cancella</a>
        <a class="btn btn-cart right" href="">TOTALE {{ food.price }} €</a>
      </div>
    </div>
  </div>

  <Loader v-else />
</template>

<script>
import axios from "axios";

import Cart from "./components/Cart.vue";
import Loader from "./components/Loader.vue";
import AddBtn from "./components/AddBtn.vue";

// const items = Object.freeze(
//   axios
//     .get(`http://127.0.0.1:8000/api/restaurants/${this.$route.params.id}`)
//     .then((res) => {
//       //   const restaurantDetail = Object.assign({}, res.data);
//       return res.data[1];
//       // this.items = res.data[1];
//       // console.log(res.data[1]);
//       //   console.log(this.restaurantDetail);
//     })
// );

export default {
  name: "RestaurantDetail",

  components: {
    Cart,
    AddBtn,
    Loader,
  },

  data() {
    return {
      restaurant: [],
      // foods: [],
      cart: [],
      items: [],
      componentKey: 0,
      foodId: 0,

      modalVisibility: false,
    };
  },
  created() {
    // this.items;
    this.getRestaurant();
    console.log(this.items);
    this.reactiveBtns();
    // console.log(this.foods);
  },
  updated() {
    console.log(this.cart);
    console.log(localStorage.getItem("cart"));
    // this.resetBasket();
    // this.reactiveBtns();
  },

  methods: {
    getRestaurant() {
      axios
        .get(`http://127.0.0.1:8000/api/restaurants/${this.$route.params.id}`)
        .then((res) => {
          //   const restaurantDetail = Object.assign({}, res.data);
          this.restaurant = res.data[0];
          this.items = res.data[1];
          // this.items = res.data[1];
          // console.log(res.data[1]);
          //   console.log(this.restaurantDetail);
        });
    },
    isInCart(itemId) {
      if (!localStorage.getItem("cart")) {
        localStorage.setItem("cart", JSON.stringify([]));
      }
      const cartItem = this.cart.find(({ id }) => id === itemId);
      return Boolean(cartItem);
    },
    addToCart(itemId) {
      const item = this.items.find(({ id }) => id === itemId);
      if (!localStorage.getItem("cart")) {
        localStorage.setItem("cart", JSON.stringify([]));
      }
      const cartItems = JSON.parse(localStorage.getItem("cart"));
      cartItems.push(item);
      localStorage.setItem("cart", JSON.stringify(cartItems));
      this.cart = JSON.parse(localStorage.getItem("cart"));
      this.forceRerender();
    },
    removeFromCart(itemId) {
      const cartItems = JSON.parse(localStorage.getItem("cart"));
      const index = cartItems.findIndex(({ id }) => id === itemId);
      cartItems.splice(index, 1);
      localStorage.setItem("cart", JSON.stringify(cartItems));
      this.cart = JSON.parse(localStorage.getItem("cart"));
      this.forceRerender();
    },
    forceRerender() {
      this.componentKey += 1;
    },
    reactiveBtns() {
      if (!localStorage.getItem("cart")) {
        localStorage.setItem("cart", JSON.stringify([]));
      }
      this.cart = JSON.parse(localStorage.getItem("cart"));
    },
    resetBasket() {
      // const restaurants_id = [];

      // this.cart.forEach((element) => {
      //   if (!restaurants_id.includes(element.restaurant_id))
      //     restaurants_id.push(element.restaurant_id);
      // });

      // restaurants_id.sort();

      if (this.cart[0]) {
        this.cart.forEach((element) => {
          if (this.cart[0].restaurant_id != element.restaurant_id) {
            console.log(
              "cazzi",
              this.cart[0].restaurant_id,
              element.restaurant_id
            );
            alert("attenzione non puoi ordinare da 2 ristoranti");
          }
        });
      }
    },

    modalVisibilityShow(id) {
      this.foodId = id;
    },
  },
};
</script>

<style lang="scss" scoped>
.image img {
  width: 100%;
  margin-top: 20px;
}

.info {
  margin-left: 1rem;
  margin-top: 20px;
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

// MODAL
.modal {
  max-width: 375px;
  height: 420px;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  background: #fff;
  border-radius: 5px;
  display: flex;
  flex-direction: column;
  align-items: center;
  box-shadow: 0px 0px 5px red;

  .title {
    height: 60px;
    padding-top: 20px;
  }

  .info-modal {
    flex-grow: 1;
    border-top: 1px solid #e8ebeb;
    border-bottom: 1px solid #e8ebeb;
    padding: 20px;
    width: 100%;
  }

  .button {
    height: 90px;
    display: flex;
    align-items: center;
    margin: 0 20px;

    .left {
      min-width: 80px;
      border: 1px solid #e8ebeb;
      background: #fff;
      color: #00ccbc;
      display: inline-block;
      text-align: center;
      padding: 15px;
      margin-right: 20px;
    }

    .right {
      min-width: 230px;
      display: inline-block;
      text-align: center;
      padding: 15px;
    }
  }
}

.mb-2 {
  margin-bottom: 20px;
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
    justify-content: space-between;
    margin: 0 1rem;
    position: relative;

    .cards {
      display: flex;
      flex-wrap: wrap;
      flex-basis: 80%;
      margin: 0;

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
      position: absolute;
      right: 0;
      top: -100px;
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
