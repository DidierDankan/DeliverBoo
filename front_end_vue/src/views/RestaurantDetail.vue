<template>
  <div class="detail-container">
    <div v-if="restaurant.name">
      <div class="detail container">
        <div class="image">
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
        </div>
        <div class="info">
          <h1 class="text-color-tertiary margin-bottom">
            {{ restaurant.name }}
          </h1>
          <div>
            <span
              class="badge-type"
              v-for="(type, index) in restaurant.types"
              :key="index"
              >{{ type.type }}
            </span>
          </div>
          <div class="margin-top">
            <span class="text-color-tertiary">{{ restaurant.address }}, </span>
            <span class="text-color-tertiary">{{ restaurant.city }}, </span>
            <span class="text-color-tertiary">{{ restaurant.zip_code }}</span>
          </div>
        </div>
      </div>

      <div class="foods">
        <div class="container-db">
          <h1 class="text-color-tertiary">Cibi</h1>

          <div class="flex p2rem">
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
                  @click="modalVisibilityShow(food.id, restaurant.id)"
                >
                  <div class="info-food">
                    <div class="mb text-color-tertiary">{{ food.title }}</div>
                    <div class="text-color mb" v-if="food.visibility === 0">
                      Non Disponibile
                    </div>
                    <div class="text-color mb overflow" v-else>
                      {{ food.description }}
                    </div>
                    <div class="text-color mb">
                      {{ food.price.toFixed(2) }} €
                    </div>
                  </div>
                  <div class="cover" v-if="food.cover">
                    <div class="cropper">
                      <img
                        :src="
                          `http://127.0.0.1:8000/storage/foods-covers/${food.cover}`
                        "
                        :alt="food.title"
                      />
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="cart">
              <div class="header">
                <h2>Il tuo carrello:</h2>
              </div>

              <Cart @click="forceRerender()" :key="componentKey" />

              <button
                v-show="cart.length > 0"
                class="cassa"
                @click="modalCheckoutOpen()"
              >
                Vai alla Cassa
              </button>
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
            <h3 class="text-color-tertiary">{{ food.title }}</h3>
            <div @click="modalVisibility = false" class="close">
              <i class="fas fa-times"></i>
            </div>
          </div>
          <div class="cover-modal">
            <img
              :src="`http://127.0.0.1:8000/storage/foods-covers/${food.cover}`"
              :alt="food.title"
            />
          </div>
          <div class="info-modal">
            <div class="mb-2">
              <span class="text-color-tertiary"
                ><strong>Descrizione: </strong>
                {{ food.description }}
              </span>
            </div>
            <div>
              <span class="text-color-tertiary"
                ><strong>Ingredienti: </strong>

                {{ food.ingredients }}
              </span>
            </div>
          </div>

          <AddBtn
            v-show="food.visibility"
            @click="forceRerender()"
            :key="componentKey"
            :items="items"
            :food="food"
          />

          <div class="button" v-show="food.visibility">
            <div
              v-if="multipleItemCounts(food.id) > 0"
              @click="removeItem(food.id)"
              class="btn btn-cart left"
            >
              Cancella
            </div>
            <a
              v-if="multipleItemCounts(food.id) > 0"
              v-show="food.visibility"
              class="btn btn-cart right"
              @click.prevent="modalVisibility = false"
              href=""
              >Parziale
              {{ (food.price * multipleItemCounts(food.id)).toFixed(2) }} €</a
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
        <div class="modal-db-pay cart-2" @click.stop v-show="modalCheckout">
          <div class="title-2 margin">
            Il tuo ordine:
            <div @click="modalCheckoutClose()" class="close">
              <i class="fas fa-times"></i>
            </div>
          </div>

          <Checkout @orderPassed="renderIf" :key="componentKey" />
        </div>
      </div>

      <!-- Modal Switch Restaurant -->
      <div class="modal-container-db" v-if="resetBasketModal">
        <div class="modal-db switch">
          <div class="header-switch">
            <h2>Attenzione:</h2>
          </div>
          <div class="text-switch">
            Non puoi ordinare da 2 ristoranti diversi.<br />
            Se non svuoti il carrello verrai reindirizzato al precedente
            ristorante per il checkout.<br /><br />
            Vuoi svuotare il carrello?
          </div>
          <div class="button-switch">
            <button class="yes" @click.prevent="resetBasketTrue()">Si</button>
            <button class="no" @click.prevent="resetBasketFalse()">No</button>
          </div>
        </div>
      </div>

      <!-- modal order successfully submitted -->

      <div
        class="modal-container-db"
        v-if="modalSuccess"
        @click="modalSuccessClose()"
      >
        <div @click.stop class="modal-db switch">
          <div class="header-switch">
            <h2>Conferma d'ordine</h2>
          </div>
          <div class="text-switch">
            Il tuo ordine è stato ricevuto.<br />
            A breve riceverai una mail di conferma.<br /><br />
            Grazie per aver scelto DeliveBoo!
          </div>
          <div class="button-switch">
            <button class="no" @click.prevent="modalSuccessClose()">
              Esci
            </button>
          </div>
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
      clientToken: "",
      resetBasketModal: false,
      resetBasketOption: undefined,
      modalSuccess: false,
    };
  },

  created() {
    this.getRestaurant();
    this.reactiveBtns();
  },

  updated() {
    this.cart = JSON.parse(localStorage.getItem("cart"));
  },

  methods: {
    renderIf(value) {
      if (value) {
        setTimeout(this.modalSuccessOpen, 2000);
        setTimeout(this.forceRerender, 5000);
      }
    },
    modalSuccessOpen() {
      this.modalSuccess = true;
      this.modalCheckoutClose();
      this.forceRerender();
    },
    modalSuccessClose() {
      this.modalSuccess = false;
      this.forceRerender();
      location.href = "http://localhost:8080/#/";
    },

    getRestaurant() {
      axios
        .get(`http://127.0.0.1:8000/api/restaurants/${this.$route.params.id}`)
        .then((res) => {
          this.restaurant = res.data[0];
          this.items = res.data[1];
        });
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
    modalVisibilityShow(id, restaurant_id) {
      this.foodId = id;
      const cart = JSON.parse(localStorage.getItem("cart"));
      if (cart[0] && cart[0].restaurant_id != restaurant_id) {
        this.modalVisibility = false;
      } else {
        this.modalVisibility = true;
      }
      this.resetBasket(restaurant_id);
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
      this.forceRerender();
    },
    modalCheckoutOpen() {
      this.modalCheckout = true;
      this.forceRerender();
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
    resetBasket(restaurant_id) {
      const cart = JSON.parse(localStorage.getItem("cart"));

      if (cart[0] && cart[0].restaurant_id != restaurant_id) {
        this.resetBasketModal = true;
      }
    },
    resetBasketTrue() {
      localStorage.setItem("cart", JSON.stringify([]));
      this.forceRerender();
      this.resetBasketModal = false;
      this.modalVisibility = true;
    },
    resetBasketFalse() {
      const cart = JSON.parse(localStorage.getItem("cart"));
      let oldRestaurant = cart[0].restaurant_id;
      location.href = `http://localhost:8080/#/restaurants/${oldRestaurant}`;
      this.modalVisibility = false;
      location.reload();
      this.resetBasketModal = false;
    },
  },
};
</script>

<style lang="scss" scoped>
@import "@/style/restaurantDetails.scss";
</style>
