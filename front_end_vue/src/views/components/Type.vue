<template>
  <h1>In quale tipo di ristorante vuoi ordinare?</h1>
  <div class="container">
    <div class="card-container">
      <label class="card" v-for="(tipo, index) in listTypes" :key="index">
        <input type="checkbox" class="checkbox hidden" />
        <div class="tipologia">
          <p>{{ tipo.type }}</p>
        </div>
      </label>
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
    };
  },
  created() {
    this.getType();
  },

  methods: {
    getType() {
      axios
        .get("http://127.0.0.1:8000/api/types")
        .then((res) => {
          console.log(res.data);
          this.listTypes = res.data;
        })
        .catch((error) => {
          console.log("error", error);
        });
    },
  },
};
</script>

<style scoped>
h1 {
  margin: 30px 0;
  text-align: center;
  color: #2e3333;
}

a {
  text-decoration: none;
}
.hidden {
  display: none;
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
  margin: 7px;
}

.card .tipologia {
  padding: 20px;
  background-color: #d2d8df;
  display: flex;
  flex-wrap: wrap;
  flex-direction: row;
  justify-content: center;
  align-items: center;
  align-content: center;
  border-radius: 20px;
  cursor: pointer;
}

.card label {
  font-size: 22px;
  color: black;
  font-weight: bold;
  cursor: pointer;
}

.card .checkbox:checked ~ .tipologia {
  background: #43ccbc;
}

.card .tipologia:hover {
  background-color: #d0eb99;
}

.tipologia p {
  font-size: 20px;
  font-weight: bold;
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