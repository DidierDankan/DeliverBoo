<template>
  <div class="bg-container">
    <div class="footer-container">
      <h3>Grazie per aver scelto il servizio di DeliveBoo</h3>
    </div>
  </div>
</template>

<script>
export default {
  name: "Footer",
};
</script>

<style scoped lang="scss">
.bg-container {
  background: #434848;
  height: 65px;
  .footer-container {
    max-width: 1170px;
    margin: 0 auto;
    text-align: center;
    h3 {
      padding-top: 20px;
      color: #fff;
    }
  }
}
</style>
