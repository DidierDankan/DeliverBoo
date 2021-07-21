<template>
  <div v-if="clientToken" class="container">
    <div class="col-12 ">
      <div>
        <div>Informazioni pagamento</div>
        <div>
          <div class="alert alert-success" v-if="nonce">
            Il pagamento è andato a buon fine.
          </div>
          <div class="alert alert-danger" v-if="error">
            {{ error }}
          </div>
          <form>
            <div class="row">
              <div class="mb-3 col-md-6 col-sm-12">
                <label for="customerName" class="form-label">Nome</label>
                <input
                  type="text"
                  v-model="name"
                  class="form-control"
                  id="customerName"
                />
              </div>
              <div class="mb-3 col-md-6 col-sm-12">
                <label for="customerSurname" class="form-label">Cognome</label>
                <input
                  type="text"
                  v-model="surname"
                  class="form-control"
                  id="customerSurname"
                />
              </div>
            </div>

            <div class="row">
              <div class="mb-3 col-md-6 col-sm-12">
                <label for="customerMail" class="form-label">Email</label>
                <input
                  type="email"
                  v-model="email"
                  class="form-control"
                  id="customerMail"
                />
              </div>
              <div class="mb-3 col-md-6 col-sm-12">
                <label for="customerPhone" class="form-label">Telefono</label>
                <input
                  type="text"
                  v-model="phone"
                  class="form-control"
                  id="customerPhone"
                />
              </div>
            </div>

            <div class="mb-3">
              <label for="customerAddress" class="form-label">Indirizzo</label>
              <input
                type="text"
                v-model="address"
                class="form-control"
                id="customerAddress"
              />
            </div>

            <div class="row">
              <div class="mb-3 col-md-6 col-sm-12">
                <label for="customerZipCode" class="form-label">CAP</label>
                <input
                  type="text"
                  v-model="zip_code"
                  class="form-control"
                  id="customerZipCode"
                />
              </div>
              <div class="mb-3 col-md-6 col-sm-12">
                <label for="customerCity" class="form-label">Città</label>
                <input
                  type="text"
                  v-model="city"
                  class="form-control"
                  id="customerCity"
                />
              </div>
            </div>
            <div class="form-group">
              <label for="amount">Totale</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">€</span>
                </div>
                <div
                  id="amount"
                  class="form-control"
                  placeholder="Totale"
                  :value="amount()"
                >
                  {{ amount() }} €
                </div>
              </div>
            </div>
            <hr />
            <div class="form-group">
              <label for="creditCardNumber">Numero carta di credito</label>
              <div
                id="creditCardNumber"
                name="creditCardNumber"
                class="form-control"
              ></div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-6">
                  <label>Data di scadenza</label>
                  <div id="expireDate" class="form-control"></div>
                </div>
                <div class="col-6">
                  <label>CVV</label>
                  <div id="cvv" class="form-control"></div>
                </div>
              </div>
            </div>
            <div class="cards">
              <i class="fab fa-cc-mastercard"></i>
              <i class="fab fa-cc-amex"></i>
              <i class="fab fa-cc-visa"></i>
            </div>

            <button
              class="btn btn-block text-white mt-3"
              @click.prevent="payWithCreditCard"
            >
              Paga
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import braintree from "braintree-web";
import axios from "axios";

export default {
  created() {
    this.clientToken = JSON.parse(localStorage.getItem("clienttoken"));
  },

  updated() {
    if (this.orderPassed) {
      localStorage.setItem("orderdetails", JSON.stringify({}));
      localStorage.setItem("cart", JSON.stringify([]));
    }
  },

  mounted() {
    this.braintreeSystem();
  },

  data() {
    return {
      hostedFieldInstance: false,
      nonce: "",
      error: "",
      clientToken: "",

      name: "",
      surname: "",
      city: "",
      zip_code: "",
      address: "",
      email: "",
      phone: "",
      status: false,
      foods: {},
      // amount: 0,
      orderPassed: false,

      rerender: true,

      orderObj: {},

      cart: [],
    };
  },

  methods: {
    payWithCreditCard() {
      if (this.hostedFieldInstance) {
        this.hostedFieldInstance
          .tokenize()
          .then((payload) => {
            console.log(payload);
            this.nonce = payload.nonce;
          })
          .catch((err) => {
            console.error(err);
            this.error = err.message;
          });
      }
      if (this.nonce) {
        this.status = true;
      }

      setTimeout(this.getOrderInfo, 1000);
      setTimeout(this.sendOrder, 1500);

      this.sendRerender();
    },

    sendRerender() {
      this.$emit("status", this.rerender);
    },

    braintreeSystem() {
      if (this.clientToken) {
        braintree.client
          .create({
            // authorization: JSON.parse(localStorage.getItem("clienttoken")),
            authorization:
              "eyJ2ZXJzaW9uIjoyLCJhdXRob3JpemF0aW9uRmluZ2VycHJpbnQiOiJleUowZVhBaU9pSktWMVFpTENKaGJHY2lPaUpGVXpJMU5pSXNJbXRwWkNJNklqSXdNVGd3TkRJMk1UWXRjMkZ1WkdKdmVDSXNJbWx6Y3lJNkltaDBkSEJ6T2k4dllYQnBMbk5oYm1SaWIzZ3VZbkpoYVc1MGNtVmxaMkYwWlhkaGVTNWpiMjBpZlEuZXlKbGVIQWlPakUyTWpZNU56STFORGtzSW1wMGFTSTZJalJrWldVNVptSTNMVE5qWVdRdE5HSmxNaTA1WWpsakxXUXpORFE0TnpJNU9EQTFZeUlzSW5OMVlpSTZJamwyYm5GeE9XYzBjM0pyZDNSeWQzUWlMQ0pwYzNNaU9pSm9kSFJ3Y3pvdkwyRndhUzV6WVc1a1ltOTRMbUp5WVdsdWRISmxaV2RoZEdWM1lYa3VZMjl0SWl3aWJXVnlZMmhoYm5RaU9uc2ljSFZpYkdsalgybGtJam9pT1hadWNYRTVaelJ6Y210M2RISjNkQ0lzSW5abGNtbG1lVjlqWVhKa1gySjVYMlJsWm1GMWJIUWlPbVpoYkhObGZTd2ljbWxuYUhSeklqcGJJbTFoYm1GblpWOTJZWFZzZENKZExDSnpZMjl3WlNJNld5SkNjbUZwYm5SeVpXVTZWbUYxYkhRaVhTd2liM0IwYVc5dWN5STZlMzE5LjB1NVloYzJnYThwc19rNURpYS1BYV8xQmlSN1poSktsZm1VdFdOdE00ajh0WTZ5QTdDUm1CTWo0eFFzLS1SeTB3YXR4LXJ2T1I5aGlobzNMWV9GTWt3IiwiY29uZmlnVXJsIjoiaHR0cHM6Ly9hcGkuc2FuZGJveC5icmFpbnRyZWVnYXRld2F5LmNvbTo0NDMvbWVyY2hhbnRzLzl2bnFxOWc0c3Jrd3Ryd3QvY2xpZW50X2FwaS92MS9jb25maWd1cmF0aW9uIiwiZ3JhcGhRTCI6eyJ1cmwiOiJodHRwczovL3BheW1lbnRzLnNhbmRib3guYnJhaW50cmVlLWFwaS5jb20vZ3JhcGhxbCIsImRhdGUiOiIyMDE4LTA1LTA4IiwiZmVhdHVyZXMiOlsidG9rZW5pemVfY3JlZGl0X2NhcmRzIl19LCJjbGllbnRBcGlVcmwiOiJodHRwczovL2FwaS5zYW5kYm94LmJyYWludHJlZWdhdGV3YXkuY29tOjQ0My9tZXJjaGFudHMvOXZucXE5ZzRzcmt3dHJ3dC9jbGllbnRfYXBpIiwiZW52aXJvbm1lbnQiOiJzYW5kYm94IiwibWVyY2hhbnRJZCI6Ijl2bnFxOWc0c3Jrd3Ryd3QiLCJhc3NldHNVcmwiOiJodHRwczovL2Fzc2V0cy5icmFpbnRyZWVnYXRld2F5LmNvbSIsImF1dGhVcmwiOiJodHRwczovL2F1dGgudmVubW8uc2FuZGJveC5icmFpbnRyZWVnYXRld2F5LmNvbSIsInZlbm1vIjoib2ZmIiwiY2hhbGxlbmdlcyI6W10sInRocmVlRFNlY3VyZUVuYWJsZWQiOnRydWUsImFuYWx5dGljcyI6eyJ1cmwiOiJodHRwczovL29yaWdpbi1hbmFseXRpY3Mtc2FuZC5zYW5kYm94LmJyYWludHJlZS1hcGkuY29tLzl2bnFxOWc0c3Jrd3Ryd3QifSwicGF5cGFsRW5hYmxlZCI6dHJ1ZSwicGF5cGFsIjp7ImJpbGxpbmdBZ3JlZW1lbnRzRW5hYmxlZCI6dHJ1ZSwiZW52aXJvbm1lbnROb05ldHdvcmsiOnRydWUsInVudmV0dGVkTWVyY2hhbnQiOmZhbHNlLCJhbGxvd0h0dHAiOnRydWUsImRpc3BsYXlOYW1lIjoiaHVidXJ0ZGV2IiwiY2xpZW50SWQiOm51bGwsInByaXZhY3lVcmwiOiJodHRwOi8vZXhhbXBsZS5jb20vcHAiLCJ1c2VyQWdyZWVtZW50VXJsIjoiaHR0cDovL2V4YW1wbGUuY29tL3RvcyIsImJhc2VVcmwiOiJodHRwczovL2Fzc2V0cy5icmFpbnRyZWVnYXRld2F5LmNvbSIsImFzc2V0c1VybCI6Imh0dHBzOi8vY2hlY2tvdXQucGF5cGFsLmNvbSIsImRpcmVjdEJhc2VVcmwiOm51bGwsImVudmlyb25tZW50Ijoib2ZmbGluZSIsImJyYWludHJlZUNsaWVudElkIjoibWFzdGVyY2xpZW50MyIsIm1lcmNoYW50QWNjb3VudElkIjoiaHVidXJ0ZGV2IiwiY3VycmVuY3lJc29Db2RlIjoiRVVSIn19",
          })
          .then((clientInstance) => {
            let options = {
              client: clientInstance,
              styles: {
                input: {
                  "font-size": "16px",
                  "font-family": "sans-serif",
                },
              },
              fields: {
                number: {
                  selector: "#creditCardNumber",
                  placeholder: "Inserisci la carta di credito",
                },
                cvv: {
                  selector: "#cvv",
                  placeholder: "Inserisci il CVV",
                },
                expirationDate: {
                  selector: "#expireDate",
                  placeholder: "00 / 0000",
                },
              },
            };
            return braintree.hostedFields.create(options);
          })
          .then((hostedFieldInstance) => {
            this.hostedFieldInstance = hostedFieldInstance;
          });
      }
    },
    getOrderInfo() {
      if (this.nonce) {
        this.status = true;
      }

      this.orderObj = {
        name: this.name,
        surname: this.surname,
        phone: this.phone,
        email: this.email,
        address: this.address,
        zip_code: this.zip_code,
        city: this.city,
        status: this.status,
        food: this.itemQnt(),
        amount: this.amount(),
      };

      if (!localStorage.getItem("orderdetails")) {
        localStorage.setItem("orderdetails", JSON.stringify({}));
      }

      localStorage.setItem("orderdetails", JSON.stringify(this.orderObj));
    },
    itemQnt() {
      const items = JSON.parse(localStorage.getItem("cart"));

      const itemsId = [];

      let restaurantID = 0;

      items.forEach((element) => {
        itemsId.push(element.id);
        restaurantID = element.restaurant_id;
      });

      const final = {
        items: itemsId,
        restaurant_id: restaurantID,
      };

      return final;
    },
    amount() {
      const array = [];

      JSON.parse(localStorage.getItem("cart")).forEach((element) => {
        array.push(element.price);
      });

      let amount = 0;

      array.forEach((v) => {
        amount += v;
      });

      return amount;
    },
    sendOrder() {
      axios
        .get("http://127.0.0.1:8000/api/orders/get", {
          params: {
            order: localStorage.getItem("orderdetails"),
          },
        })
        .then((res) => {
          this.orderPassed = res.data;

          if (res.data) {
            localStorage.setItem("cart", JSON.stringify([]));
            localStorage.setItem("orderdetails", JSON.stringify({}));
          }
        });
    },
  },
};
</script>

<style scoped lang="scss">
@import "node_modules/bootstrap/scss/bootstrap.scss";
@import "@/style/vars.scss";

#creditCardNumber,
#expireDate,
#cvv {
  margin: 10px 0px;
}
.form-control {
  height: 35px;
}

.btn {
  width: 100%;
  background: $btn-color;
}
.cards {
  i {
    font-size: 4rem;
    padding-right: -10px;
    padding-left: -10px;
  }

  text-align: center;
}
</style>
