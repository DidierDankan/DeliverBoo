<template>

  <div class="macro-container">
    <Header />

    <router-view />

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
