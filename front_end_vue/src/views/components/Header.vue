<template>
  <div class="container-header">
    <router-link class="links brand" to="/">DeliveBoo</router-link>
    <div id="nav">
      <router-link class="links" to="/">Home</router-link> |
      <router-link class="links" to="/about">About</router-link> |
      <router-link class="links" to="/restaurants">Restaurants</router-link>
    </div>
  </div>
</template>

<script>
export default {
  name: "Header",
};
</script>

<style lang="scss">
.container-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 10px;
  background-color: #00ccbc;
  .links {
    text-decoration: none;
    color: #fff;
  }
  .brand {
    font-size: 2rem;
  }
  #nav {
    padding: 10px;
  }
}
</style>
