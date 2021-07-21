<template>
  <div class="container">
    <a class="btn" @click="removeFromCart(food.id)">-</a>

    <div class="count">{{ multipleItemCounts(food.id) }}</div>
    <a class="btn" v-show="food.visibility" @click="addToCart(food)">+</a>
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
    this.reactiveBtns();
  },

  methods: {
    isInCart(itemId) {
      if (!localStorage.getItem("cart")) {
        localStorage.setItem("cart", JSON.stringify([]));
      }
      const cartItem = this.cart.find(({ id }) => id === itemId);
      return Boolean(cartItem);
    },
    addToCart(item) {
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
    multipleItemCounts(value) {
      const array = [];

      JSON.parse(localStorage.getItem("cart")).forEach((element) => {
        array.push(element.id);
      });

      return array.filter((v) => v === value).length;
    },
  },
};
</script>

<style scoped lang="scss">
.container {
  padding-top: 1rem;
  display: flex;
  justify-content: center;
}

.btn {
  display: flex;
  justify-content: center;
  align-items: center;
  width: 40px;
  height: 40px;
  color: #fff;
  background: #00ccbc;
  // padding: 15px 30px;
  border-radius: 50%;
  text-decoration: none;
  font-weight: 900;
  cursor: pointer;
  font-size: 2.2rem;
}

.count {
  margin: 0 15px;
  display: flex;
  justify-content: center;
  align-items: center;
  width: 40px;
  height: 40px;
  font-weight: 900;
  // cursor: pointer;
  font-size: 1.8rem;
}
</style>
