<template>
  <div class="bg-container">
    <div class="container-header">
      <router-link class="links brand" to="/">DeliveBoo</router-link>
      <div id="nav">
        <router-link class="links" to="/">Home</router-link> |
        <router-link class="links" to="/about">About</router-link> |
        <router-link class="links" to="/restaurants">Restaurants</router-link>
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
.bg-container {
  background-color: #00ccbc;
  .container-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    max-width: 1170px;
    margin: 0 auto 20px;
    padding: 10px 0px;
    .links {
      text-decoration: none;
      color: #fff;
      &:hover {
        color: rgb(228, 222, 222);
      }
    }
    .brand {
      margin-left: 1rem;
      font-size: 2rem;
    }
    #nav {
      margin-right: 1rem;
    }
  }
}
</style>
