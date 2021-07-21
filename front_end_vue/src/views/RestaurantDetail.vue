<template>
  <div class="detail-container">
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
        <div class="container-db">
          <h1>Cibi</h1>
          <div class="flex">
            <div class="cards">
              <div class="card-container cards" @click.stop>
                <div
                  class="card"
                  :class="{
                    notAvailable: !food.visibility,
                    selectedFood: idInArray(food.id),
                  }"
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
                </div>
              </div>
            </div>
            <div class="cart">
              <div class="header">
                <h2>Il tuo carrello:</h2>
              </div>

              <Cart @click="forceRerender()" :key="componentKey" />

              <button @click="modalCheckoutOpen()">test checkout</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal -->
      <div
        class="modal-container-db"
        v-show="modalVisibility"
        @click="modalVisibility = false"
      >
        <div
          class="modal-db"
          v-show="food.id == foodId && modalVisibility"
          v-for="(food, index) in items"
          :key="index"
          @click.stop
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

          <AddBtn
            v-show="food.visibility"
            @click="forceRerender()"
            :key="componentKey"
            :items="items"
            :food="food"
          />

          <div class="button">
            <div @click="removeItem(food.id)" class="btn btn-cart left">
              Cancella
            </div>
            <a
              class="btn btn-cart right"
              @click.prevent="modalVisibility = false"
              href=""
              >TOTALE {{ food.price * multipleItemCounts(food.id) }} €</a
            >
          </div>
        </div>
      </div>

      <!-- Modal Cart -->
      <div
        class="modal-container-db"
        v-show="modalCheckout"
        @click="modalCheckoutClose()"
      >
        <div class="modal-db cart-2" @click.stop v-show="modalCheckout">
          <div class="title-2 margin">Carrello</div>
          <div class="amount">
            <div>Totale</div>
            <div>10€</div>
          </div>
          <div class="title-2 margin">I tuoi dati</div>

          <Checkout />

        </div>
      </div>
    </div>

    <Loader v-else />

  </div>
</template>

<script>
import axios from "axios";

import Cart from "./components/Cart.vue";
import Loader from "./components/Loader.vue";
import AddBtn from "./components/AddBtn.vue";
import Checkout from "./components/Checkout.vue";

export default {
  name: "RestaurantDetail",

  components: {
    Cart,
    AddBtn,
    Loader,
    Checkout,
  },

  data() {
    return {
      restaurant: [],
      cart: [],
      items: [],
      componentKey: 0,
      foodId: 0,
      modalCheckout: false,
      modalVisibility: false,
      name: "",
      surname: "",
      city: "",
      zip_code: "",
      address: "",
      email: "",
      phone: "",
      orderObj: [],
    };
  },

  created() {
    this.getRestaurant();
    this.reactiveBtns();
  },

  updated() {
    this.renderAfterOrder();
  },

  methods: {
    getRestaurant() {
      axios
        .get(`http://127.0.0.1:8000/api/restaurants/${this.$route.params.id}`)
        .then((res) => {
          this.restaurant = res.data[0];
          this.items = res.data[1];
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
      if (this.cart[0]) {
        this.cart.forEach((element) => {
          if (this.cart[0].restaurant_id != element.restaurant_id) {
            alert("attenzione non puoi ordinare da 2 ristoranti");
          }
        });
      }
    },
    multipleItemCounts(value) {
      const array = [];

      JSON.parse(localStorage.getItem("cart")).forEach((element) => {
        array.push(element.id);
      });

      return array.filter((v) => v === value).length;
    },
    idInArray(value) {
      const array = [];

      JSON.parse(localStorage.getItem("cart")).forEach((element) => {
        array.push(element.id);
      });

      if (array.includes(value)) {
        return true;
      }
    },
    modalVisibilityShow(id) {
      this.foodId = id;
      this.modalVisibility = true;
    },
    changeFoodId() {
      this.foodId = 10000000;
    },
    passTest() {
      axios
        .get("http://127.0.0.1:8000/api/orders/get", {
          params: {
            order: localStorage.getItem("orderdetails"),
          },
        })
        .then((res) => {
          console.log(res.data);
        });
    },
    modalCheckoutClose() {
      this.modalCheckout = false;
    },
    modalCheckoutOpen() {
      this.modalCheckout = true;
    },
    getOrderInfo() {
      this.orderObj.push(
        this.name,
        this.surname,
        this.email,
        this.phone,
        this.address,
        this.zip_code,
        this.city
      );

      if (!localStorage.getItem("orderdetails")) {
        localStorage.setItem("orderdetails", JSON.stringify([]));
      }

      localStorage.setItem("orderdetails", JSON.stringify(this.orderObj));
    },
    renderAfterOrder() {
      if (!localStorage.getItem("cart")) {
        localStorage.setItem("cart", JSON.stringify([]));
      }
      const cartItems = JSON.parse(localStorage.getItem("cart"));
      if (cartItems.length == 0) {
        this.forceRerender();
      }
    },
    removeItem(itemid) {
      const cartItems = JSON.parse(localStorage.getItem("cart"));

      const arr = [];

      cartItems.forEach((e) => {
        if (e.id != itemid) {
          arr.push(e);
        }
      });

      localStorage.setItem("cart", JSON.stringify(arr));
      this.forceRerender();
    },
  },
};
</script>

<style lang="scss" scoped>
@import "node_modules/bootstrap/scss/bootstrap.scss";

.detail-container {
  scroll-snap-type: y mandatory;
}

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

  .selectedFood {
    border-left: 5px solid #00ccbc !important;
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

  .header {
    color: #fff;
    background: #00ccbc;
    margin-top: -2px !important;
    padding: 1rem 0;
    margin-bottom: -50px !important;
  }
  .cart {
    overflow: hidden;
    box-shadow: rgba(0, 0, 0, 0.137) 0px 3px 8px;
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
  cursor: pointer;
}

.modal-container-db {
  position: fixed;
  top: 0;
  left: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  background-color: rgba(0, 0, 0, 0.146);
  height: 100vh;
  width: 100vw;
  scroll-snap-align: start;
}
// MODAL
.modal-db {
  width: 50%;
  height: 90vh;
  background: #fff;
  border-radius: 5px;
  display: flex;
  flex-direction: column;
  align-items: center;
  box-shadow: 15px 15px 25px rgba(0, 0, 0, 0.112);
  overflow-y: auto;

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

// MODAL CART
.cart-2 {
  padding: 1rem;
  align-items: start;

  .title-2 {
    font-size: 1.5rem;
    font-weight: 700;
  }

  .amount {
    display: flex;
    justify-content: space-between;
    width: 100%;
  }
}

.margin {
  margin: 1rem 0;
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
    .container-db {
      max-width: 1170px;
      margin: 0 auto;
    }
  }
}
</style>
