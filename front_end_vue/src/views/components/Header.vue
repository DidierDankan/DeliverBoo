<template>
  <div class="bg-container">
    <div class="container-header">
      <router-link class="links brand" to="/">DeliveBoo</router-link>
      <div id="nav">
        <router-link class="links" to="/">Ristoranti</router-link> |

        <router-link
          @click.prevent="preventCrash()"
          :to="{
            name: 'restaurant-detail',
            params: { id: getRestaurantId() },
          }"
        >
          <i class="fas fa-shopping-cart"></i>
        </router-link>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Header",

  data() {
    return {
      modalStatus: false,
      componentKey: 0,
    };
  },

  methods: {
    openClose() {
      this.modalStatus = !this.modalStatus;
      this.forceRerender();
    },
    closeModal() {
      this.modalStatus = false;
    },
    forceRerender() {
      this.componentKey += 1;
    },
    getRestaurantId() {
      if (localStorage.getItem("cart") != "[]") {
        const cart = JSON.parse(localStorage.getItem("cart"));

        return cart[0].restaurant_id;
      }
    },
    preventCrash() {
      const cart = JSON.parse(localStorage.getItem("cart"));

      if (cart.length == 0) {
        alert("Il tuo carrello è vuoto");
        location.href = "http://localhost:8080/#/";
      }
    },
  },
};
</script>

<style scoped lang="scss">
@import "@/style/header.scss";

i {
  color: #fff;
  transition: all 400ms;
  &:hover {
    color: $tertiary-color;
  }
}
</style>
