<template>
  <div>
    <h1>Store</h1>
    <div v-for="item of items" :key="item.id">
      <p>{{ item.name }}</p>
      <img :src="item.imageUrl" />
      <button @click="removeFromCart(item.id)" v-if="isInCart(item.id)">
        remove from cart
      </button>
      <button @click="addToCart(item.id)" v-else>add to cart</button>
    </div>
    <button @click="$router.push('/cart')">check out</button>
  </div>
</template>

<script>
const items = Object.freeze([
  {
    id: 1,
    imageUrl: "grape.jpg",
    name: "grape",
  },
  {
    id: 2,
    imageUrl: "orange.jpg",
    name: "orange",
  },
  {
    id: 3,
    imageUrl: "apple.jpg",
    name: "apple",
  },
]);

export default {
  name: "Store",
  data() {
    return {
      items,
      cart: [],
    };
  },
  methods: {
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
    },
    removeFromCart(itemId) {
      const cartItems = JSON.parse(localStorage.getItem("cart"));
      const index = cartItems.findIndex(({ id }) => id === itemId);
      cartItems.splice(index, 1);
      localStorage.setItem("cart", JSON.stringify(cartItems));
      this.cart = JSON.parse(localStorage.getItem("cart"));
    },
  },
};
</script>

<style></style>
