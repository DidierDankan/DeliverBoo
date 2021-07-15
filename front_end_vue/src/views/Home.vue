<template>
  <div class="home">
    <!-- <img alt="Vue logo" src="../assets/logo.png" /> -->
    <!-- <HelloWorld msg="Welcome to Your Vue.js App"/> -->
    <Hero />
  </div>
</template>

<script>
// @ is an alias to /src
// import HelloWorld from '@/components/HelloWorld.vue'
import Hero from "@/views/components/Hero";
export default {
  name: "Home",
  components: {
    // HelloWorld
    Hero,
  },
};
</script>
