<template>
  <div class="container">
    <a class="btn" @click="removeFromCart(food.id)">Rimuovi</a>
    <a class="btn" v-show="food.visibility" @click="addToCart(food)"
      >Aggiungi</a
    >
  </div>
</template>

<script>
export default {
  name: "AddBtn",
  props: ["food", "items"],

  data() {
    return {
      cart: [],

      componentKey: 0,
    };
  },

  created() {
    console.log(this.food);
    this.reactiveBtns();
  },

  updated() {},

  methods: {
    isInCart(itemId) {
      if (!localStorage.getItem("cart")) {
        localStorage.setItem("cart", JSON.stringify([]));
      }
      const cartItem = this.cart.find(({ id }) => id === itemId);
      return Boolean(cartItem);
    },
    addToCart(item) {
      // const item = this.items.find(({ id }) => id === itemId);
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
  },
};
</script>

<style scoped lang="scss">
.btn {
  color: #fff;
  background: #00ccbc;
  padding: 10px;
  border-radius: 5px;
  text-decoration: none;
}
</style>
