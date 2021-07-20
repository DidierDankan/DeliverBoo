<template>
  <div>
    <div v-if="cart.length > 0" class="items">
      <div v-for="c of uniqueCart" :key="c.id">
        <div class="item">
          <div class="flex">
            <span>{{ c.title }} </span>
            <span>
              {{ `: ${(c.price * multipleItemCounts(c.id)).toFixed(2)} ` }}
              €</span
            >
          </div>
          <!-- <img :src="c.imageUrl" /> -->
          <div class="flex">
            <span class="btn" @click="removeFromCart(c.id)">-</span>
            <span class="num">{{ multipleItemCounts(c.id) }}</span>
            <span class="btn" @click="addToCart(c)">+</span>
          </div>
        </div>
      </div>
    </div>
    <h3 v-else>Il tuo carrello è vuoto!</h3>
    <h3>Totale: {{ amountR.toFixed(2) }} €</h3>

    <a class="cash" @click.prevent="resetBasket()" href=""
      >Vai alla cassa reset</a
    >
  </div>
</template>

<script>
export default {
  name: "Cart",
  data() {
    return {
      cart: [],
      uniqueCart: [],
      amountR: 0,
    };
  },
  methods: {
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
    },
    getCart() {
      if (!localStorage.getItem("cart")) {
        localStorage.setItem("cart", JSON.stringify([]));
      }
      this.cart = JSON.parse(localStorage.getItem("cart"));
    },
    removeDouble() {
      const items = JSON.parse(localStorage.getItem("cart")); // Some array I got from async call

      const uniqueitems = Array.from(new Set(items.map((a) => a.id))).map(
        (id) => {
          return items.find((a) => a.id === id);
        }
      );

      this.uniqueCart = uniqueitems;
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
              "attenzione",
              this.cart[0].restaurant_id,
              element.restaurant_id
            );
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
    amount() {
      const array = [];

      JSON.parse(localStorage.getItem("cart")).forEach((element) => {
        array.push(element.price);
      });

      let amount = 0;

      array.forEach((v) => {
        amount += v;
      });

      this.amountR = amount;
    },
  },
  beforeMount() {
    this.getCart();
    this.removeDouble();
    this.amount();
    console.log("maronno", this.uniqueCart);
  },
};
</script>

<style scoped lang="scss">
.items {
  margin-bottom: 3rem;
}

.item {
  display: flex;
  flex-direction: column;
  align-items: center;
  // border-radius: 20px;
  padding: 1rem 0;
  border-bottom: 1px solid #22d5d54a;
}

.flex {
  margin: 5px 0;
  display: flex;
  align-items: center;
}

.num {
  display: flex;
  justify-content: center;
  align-items: center;
  width: 24px;
  height: 24px;
  font-size: 1.2rem;
}

.btn {
  display: flex;
  justify-content: center;
  align-items: center;
  width: 24px;
  height: 24px;
  color: #fff;
  background: #00ccbc;
  // padding: 15px 30px;
  border-radius: 50%;
  text-decoration: none;
  font-weight: 900;
  cursor: pointer;
  font-size: 1.2rem;
}

h3 {
  margin: 2rem 0;
}

.cash {
  margin-top: 2rem;
  color: #fff;
  background: #00ccbc;
  padding: 10px;
  border-radius: 5px;
  text-decoration: none;
  cursor: pointer;
}
</style>
