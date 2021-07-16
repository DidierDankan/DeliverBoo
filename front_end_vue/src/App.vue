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
@import url("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css");
@import "@/style/vars.scss";
@import "@/style/general.scss";
</style>
