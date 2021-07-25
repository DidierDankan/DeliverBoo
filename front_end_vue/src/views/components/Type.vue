<template>
  <div class="container">
    <h1>In quale tipo di ristorante vuoi ordinare?</h1>
    <div class="card-container">
      <div
        class="card tipologia"
        :class="{
          selected:
            checkedTypes != null ? checkedTypes.includes(tipo.type) : false,
        }"
        v-for="tipo in listTypes"
        :key="tipo.id"
        @click.prevent="saveInLocalStorage(tipo.type)"
      >
        {{ tipo.type }}
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  name: "Type",

  data() {
    return {
      listTypes: [],
      checkedTypes: [],
      reRender: 0,
    };
  },

  created() {
    this.assignLocal();
    this.getType();
  },

  methods: {
    getType() {
      axios
        .get("http://127.0.0.1:8000/api/types")
        .then((res) => {
          this.listTypes = res.data;
        })
        .catch((error) => {
          console.log("error", error);
        });
    },
    saveInLocalStorage(item) {
      if (!localStorage.getItem("checkedTypes")) {
        localStorage.setItem("checkedTypes", JSON.stringify([]));
      }
      const types = JSON.parse(localStorage.getItem("checkedTypes"));

      !types.includes(item)
        ? types.push(item)
        : types.splice(types.indexOf(item), 1);

      localStorage.setItem("checkedTypes", JSON.stringify(types));
      this.checkedTypes = JSON.parse(localStorage.getItem("checkedTypes"));
    },
    assignLocal() {
      this.checkedTypes = localStorage.getItem("checkedTypes");
    },
  },
};
</script>

<style scoped lang="scss">
@import "@/style/type.scss";
</style>
