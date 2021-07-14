<template>
  <div class="container">
    <div class="card-container">
      <a href="">
        <div class="card" v-for="type in types">
          <p>{{ types.type }}</p>
        </div>
      </a>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  name: "Tipi",

  data() {
    return {
      types: [],
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
          this.types = res.data.type;
        })
        .catch((error) => {
          console.log("error", error);
        });
    },
  },
};
</script>

<style scoped>
a {
  text-decoration: none;
}
.container {
  width: 355px;
  margin: 0 auto;
}
.card-container {
  display: flex;
  flex-wrap: wrap;
  flex-direction: row;
  justify-content: center;
}

.card {
  height: 40px;
  padding: 7px;
  margin: 7px;
  background-color: #d2d8df;
  display: flex;
  flex-wrap: wrap;
  flex-direction: row;
  justify-content: center;
  align-items: center;
  align-content: center;
  border-radius: 10px;
}
.card p {
  font-size: 23px;
  color: black;
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