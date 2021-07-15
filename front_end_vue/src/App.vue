<template>

  <div class="macro-container">
    <Header />

    <router-view />

  </div>
</template>
<script>
import Header from "./views/components/Header.vue";


<style lang="scss">
body {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}


export default {
  components: { Header },
};
</script>


<style lang="scss">
  @import '@/style/vars.scss';
  @import '@/style/general.scss';
</style>
