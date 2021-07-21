<template>
  <section class="hero">
    <div class="container"> 
      <div class="hero-block">
        <h1>I piatti che ami, a domicilio.</h1>
      </div>
      <div class="hero-block">
        <div class="spot">
          <h2 class="text-light">#aCasaTuaConDeliveBoo</h2>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: 'Hero',
};
</script>

<style lang="scss" scoped>
  @import '@/style/vars.scss';
  @import '@/style/general.scss';

section.hero {
  height: 75vh;
  text-align: left;
  overflow: hidden;
  background-image: linear-gradient(
    175deg,
    #00ccbc 0%,
    #00ccbc 15%,
    #d0eb99 16%,
    #d0eb99 100%
  );

  h1 {
    font-size:2.5rem;
    color: #440063;
  }

  .container {
    height:100%;

    &>div:first-of-type {
      height: 15%;
      padding: 0.5rem;

    }

    &>div:last-of-type {
      height: 85%;
      position: relative;
      background-image:url('~@/assets/img/bg-home.svg');
      background-position-x: 50%;
      background-repeat: no-repeat;
      background-position-y: 40%;
    }
  }

  .spot {
    width: 90%;
    padding: 32px;
    position: absolute;
    bottom: 0;
    left: 5%;
    transform: rotate(3deg);
    transform-origin: left;
    -webkit-transform: rotate(3deg);
    -webkit-transform-origin: left;
    background-color: #007e8a;

    h2 {
      -webkit-transform: rotate(-3deg);
      transform: rotate(-3deg);
    }
  }
}

@media screen and (min-width: 768px) {
  section.hero {
    height: 35vh;
    background-image: linear-gradient(
      175deg,
      #00ccbc 0%,
      #00ccbc 50%,
      #d0eb99 51%,
      #d0eb99 100%,
    );

    .container {
      display: grid;
      grid-template-columns:  5fr 7fr;

      &>div:first-of-type {
         display: flex;
        align-items: center;
        height: 100%;
      }

      &>div:last-of-type {
        height: 100%;
      }
    }
    .spot {
      width: 60%;
    }
  }
}

@media screen and (min-width: 1024px) {
  section.hero {
    .container {
      grid-template-columns:  6fr 6fr;
    }
  }
}
</style>
