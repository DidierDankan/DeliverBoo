<template>
  <div>
    <h2>Il tuo carrello:</h2>
    <a class="btn btn-cart" @click.prevent="resetBasket()" href=""
      >Vai alla cassa</a
    >

    <div v-if="cart.length > 0" class="items">
      <div v-for="(c, index) of cart" :key="c.id">
        <p>{{ c.title }}</p>
        <!-- <img :src="c.imageUrl" /> -->
        <button @click="removeFromCart(index)">Rimuovi</button>
      </div>
    </div>
    <h3 v-else>Il tuo carrello è vuoto!</h3>
  </div>
</template>

<script>
export default {
  name: "Cart",
  data() {
    return {
      cart: [],
    };
  },
  methods: {
    removeFromCart(itemId) {
      const cartItems = JSON.parse(localStorage.getItem("cart"));
      const index = cartItems.findIndex(({ id }) => id === itemId);
      cartItems.splice(index, 1);
      localStorage.setItem("cart", JSON.stringify(cartItems));
      this.cart = JSON.parse(localStorage.getItem("cart"));
    },
    getCart() {
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
  },
  beforeMount() {
    this.getCart();
  },
};
</script>

<style></style>
