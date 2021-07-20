<template>
  <div v-if="clientToken" class="container">
    <div class="col-6 offset-3">
      <div class="card bg-light">
        <div class="card-header">Informazioni pagamento</div>
        <div class="card-body">
          <div class="alert alert-success" v-if="nonce">
            Il pagamento è andato a buon fine.
          </div>
          <div class="alert alert-danger" v-if="error">
            {{ error }}
          </div>
          <form>
            <div class="form-group">
              <label for="amount">Totale</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">€</span>
                </div>
                <input
                  type="number"
                  id="amount"
                  class="form-control"
                  placeholder="Totale"
                />
              </div>
            </div>
            <hr />
            <div class="form-group">
              <label>Numero carta di credito</label>
              <div id="creditCardNumber" class="form-control"></div>
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
            <button
              class="btn btn-primary btn-block"
              @click.prevent="payWithCreditCard"
            >
              Pay with Credit Card
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import braintree from "braintree-web";
// import axios from "axios";

export default {
  created() {
    this.clientToken = JSON.parse(localStorage.getItem("clienttoken"));
    // console.log(this.clientToken);
  },

  beforeMount() {
    // this.getClientToken();
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
    },

    braintreeSystem() {
      if (this.clientToken) {
        braintree.client
          .create({
            authorization: JSON.parse(localStorage.getItem("clienttoken")),
          })
          .then((clientInstance) => {
            let options = {
              client: clientInstance,
              styles: {
                input: {
                  "font-size": "14px",
                  "font-family": "Open Sans",
                },
              },
              fields: {
                number: {
                  selector: "#creditCardNumber",
                  placeholder: "Enter Credit Card",
                },
                cvv: {
                  selector: "#cvv",
                  placeholder: "Enter CVV",
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
            // @TODO - Use hostedFieldInstance to send data to Braintree
            this.hostedFieldInstance = hostedFieldInstance;
          });
        // .catch((err) => {});
      }
    },
  },
};
</script>

<style scoped lang="scss">
@import "node_modules/bootstrap/scss/bootstrap.scss";

// body {
//   padding: 20px;
// }
</style>
