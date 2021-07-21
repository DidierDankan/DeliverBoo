<template>
  <div class="bg-container">
    <div class="container-header">
      <router-link class="links brand" to="/">DeliveBoo</router-link>
      <div id="nav">
        <router-link class="links" to="/">Home</router-link> |
        <router-link class="links" to="/cart"
          ><i class="fas fa-shopping-cart"></i
        ></router-link>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Header",
};
</script>

<style scoped lang="scss">
@import "@/style/header.scss";
</style>
