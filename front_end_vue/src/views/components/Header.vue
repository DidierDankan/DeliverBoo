<template>
  <div class="bg-container">
    <div class="container-header">
      <router-link class="links brand" to="/">DeliveBoo</router-link>
      <div id="nav">
        <router-link class="links" to="/">Ristoranti</router-link> |

        <router-link
          @mousedown.prevent="preventCrash()"
          :to="{
            name: 'restaurant-detail',
            params: { id: restaurant_id },
          }"
        >
          <i class="fas fa-shopping-cart"></i>
        </router-link>
      </div>
    </div>

    <!-- cart modal -->
    <div class="modal-container-db" @click="closeModal()" v-if="modalStatus">
      <div @click.stop class="modal-db modal-animation switch">
        <div class="header-switch">
          <div @click="closeModal()" class="close">
            <i class="fas fa-times"></i>
          </div>
          <h2>Attenzione!</h2>
        </div>
        <div class="message-cart">
          Il tuo carrello è vuoto!
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Header",

  // components: {},

  data() {
    return {
      modalStatus: false,
      componentKey: 0,
      restaurant_id: undefined,
    };
  },

  methods: {
    openClose() {
      this.modalStatus = !this.modalStatus;
      this.forceRerender();
    },
    openModal() {
      this.modalStatus = true;
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

        // alert("Il tuo carrello è vuoto");
        console.log(cart[0].restaurant_id);

        this.restaurant_id = cart[0].restaurant_id;
      }
    },
    preventCrash() {
      const cart = JSON.parse(localStorage.getItem("cart"));

      if (cart.length == 0) {
        // alert("Il tuo carrello è vuoto");
        this.openModal();
        location.href = "http://localhost:8080/#/";
      } else {
        this.restaurant_id = cart[0].restaurant_id;
        this.getRestaurantId();
      }
    },
  },
};
</script>

<style scoped lang="scss">
@import "@/style/header.scss";
</style>
