<template>
  <div class="container">
    <router-link class="links brand" to="/">DeliveBoo</router-link>
    <div id="nav">
      <router-link class="links" to="/">Home</router-link> |
      <router-link class="links" to="/about">About</router-link> |
      <router-link class="links" to="/restaurants">Restaurants</router-link> |
      <router-link class="links" to="/store">store</router-link> |
      <router-link class="links" to="/cart">cart</router-link>
    </div>
  </div>
</template>

<script>
export default {
  name: "Header",
};
</script>

<style lang="scss">
.links {
  text-decoration: none;
  color: #00ccbc;
}
.brand {
  font-size: 2rem;
}
#nav {
  padding: 10px;
}
</style>
