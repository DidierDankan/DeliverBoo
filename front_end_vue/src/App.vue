<template>

  <div class="macro-container">
    <Header />

    <router-view />

  <div id="nav">
    <router-link to="/">Home</router-link> |
    <router-link to="/about">About</router-link> |
    <router-link to="/test">Test</router-link> |
    <router-link to="/tipi">Tipi</router-link>
  </div>
</template>
<script>
import Header from "./views/components/Header.vue";

export default {
  components: { Header },
};
</script>


<style lang="scss">
  @import '@/style/vars.scss';
  @import '@/style/general.scss';
</style>
