<template>
  <div class="bg-container">
    <div class="container-header">
      <router-link class="links brand" to="/">DeliveBoo</router-link>
      <div id="nav">
        <router-link class="links brand" to="/demo">Demo</router-link>

        <router-link class="links" to="/">Home</router-link> |
        <!-- <router-link class="links" to="/about">About</router-link> | -->
        <!-- <router-link class="links" to="/restaurants">Restaurants</router-link> | -->
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
.bg-container {
  background-color: #00ccbc;
  .container-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    max-width: 1170px;
    margin: 0 auto;
    padding: 10px 0px;
    .links {
      text-decoration: none;
      color: #fff;
      transition: color 0.3s;
      &:hover {
        color: rgb(27, 27, 27);
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
