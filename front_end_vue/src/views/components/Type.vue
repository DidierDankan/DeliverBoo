<template>
  <div class="container">
    <h1>In quale tipo di ristorante vuoi ordinare?</h1>
    <!-- <div class="container">
      <button @click="reRenderTypes()">bbbbb</button>

      <div
        v-for="(tipo, index) in listTypes"
        :key="reRender + index"
        id="v-model-multiple-checkboxes"
        class="card-container"
      >
        <label class="card" :key="reRender">
          
          {{ tipo.type }}
        </label>
        <input
          :key="reRender"
          :checked="
            checkedTypes != null ? checkedTypes.includes(tipo.type) : false
          "
          type="checkbox"
          class=""
          :value="tipo.type"
          v-model="checkedTypes"
          @click="saveInLocalStorage(tipo)"
        />
      </div>
    </div> -->
    <div class="card-container">
      <div
        class="card tipologia"
        :class="{
          selected:
            checkedTypes != null ? checkedTypes.includes(tipo.type) : false,
        }"
        v-for="tipo in listTypes"
        :key="tipo.id + reRender"
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

      // localChecked: [],
    };
  },
  created() {
    this.assignLocal();
    // this.reRenderTypes();

    this.getType();
    // console.log("se funziona", this.checkedTypes);
  },
  mounted() {
    // console.log("se funziona", this.checkedTypes);
    // this.assignLocal();
  },
  // updated() {
  //   console.log(this.checkedTypes);
  // },

  methods: {
    getType() {
      axios
        .get("http://127.0.0.1:8000/api/types")
        .then((res) => {
          // console.log(res.data);
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
      // const item = this.checkedTypes.find(({ id }) => id === typeId);

      // if (!localStorage.getItem("checkedTypes")) {
      //   localStorage.setItem("checkedTypes", JSON.stringify([]));
      // }

      // const types = JSON.parse(localStorage.getItem("checkedTypes"));
      // types.push(item);
      this.reRenderTypes();
      console.log("onsave", this.checkedTypes);
    },
    assignLocal() {
      this.checkedTypes = localStorage.getItem("checkedTypes");
    },
    reRenderTypes() {
      this.reRender += 1;
    },
    // isInTypes(itemId) {
    //   if (!localStorage.getItem("checkedTypes")) {
    //     localStorage.setItem("checkedTypes", JSON.stringify([]));
    //   }
    //   const typeItem = this.checkedTypes.find(({ id }) => id === itemId);
    //   return Boolean(typeItem);
    // },
  },
  beforeMount() {
    // this.assignLocal();
    // this.reRenderTypes();
    // console.log("se funziona", this.checkedTypes);
  },
};
</script>

<style scoped lang="scss">
h1 {
  margin: 30px 0;
  text-align: center;
  color: #2e3333;
}

a {
  text-decoration: none;
}

.container {
  width: 355px;
  margin: 0 auto 30px;
}
.card-container {
  display: flex;
  flex-wrap: wrap;
  flex-direction: row;
  justify-content: center;
}
.card {
  margin: 8px;
}

.tipologia:hover {
  background-color: #43ccbc;
  color: white;
}

.tipologia:active {
  background-color: #1b7e8a;
  color: white;
}

.tipologia {
  font-size: 20px;
  font-weight: bold;
  background-color: #d2d8df;
  padding: 15px;
  border-radius: 20px;
  cursor: pointer;
  transition: all 400ms;
}

.selected {
  background-color: #1b7e8a;
  color: white;
}

/* Media Queries */
@media (min-width: 768px) and (max-width: 1170px) {
  .container {
    width: 768px;
  }
}
@media (min-width: 1171px) {
  .container {
    width: 1000px;
  }
}
</style>
