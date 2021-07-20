<template>
  <!-- <div class="container">
    <br />

    <h1>Braintree Demo</h1>

    <v-braintree
      authorization="sandbox_s9rx6c2c_x742hzxzgx6gk233"
      :paypal="{ flow: 'vault' }"
      @load="onLoad(null)"
      @loadFail="onLoadFail(null)"
      @success="onSuccess(null)"
      @error="onError(null)"
    ></v-braintree>

    <br />

    <button class="btn">
      Clear Payment Selection
    </button>
  </div> -->

  <!-- <v-braintree
    authorization="sandbox_s9rx6c2c_x742hzxzgx6gk233"
    @success="onSuccess"
    @error="onError"
  ></v-braintree> -->

  <form>
    <div class="form-group">
      <label for="amount">Amount</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text">$</span>
        </div>
        <input
          type="number"
          id="amount"
          class="form-control"
          placeholder="Enter Amount"
        />
      </div>
    </div>
    <hr />
    <div class="form-group">
      <label>Credit Card Number</label>
      <div id="creditCardNumber" class="form-control"></div>
    </div>
    <div class="form-group">
      <div class="row">
        <div class="col-6">
          <label>Expire Date</label>
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
    <div class="card bg-light">
      <div class="card-header">Payment Information</div>
      <div class="card-body">
        <div class="alert alert-success" v-if="nonce">
          Successfully generated nonce.
        </div>
      </div>
    </div>
  </form>
</template>

<script>
// import braintree from 'braintree-web';

import braintree from "braintree-web";
export default {
  mounted() {
    braintree.client
      .create({
        authorization:
          "eyJ2ZXJzaW9uIjoyLCJhdXRob3JpemF0aW9uRmluZ2VycHJpbnQiOiJleUowZVhBaU9pSktWMVFpTENKaGJHY2lPaUpGVXpJMU5pSXNJbXRwWkNJNklqSXdNVGd3TkRJMk1UWXRjMkZ1WkdKdmVDSXNJbWx6Y3lJNkltaDBkSEJ6T2k4dllYQnBMbk5oYm1SaWIzZ3VZbkpoYVc1MGNtVmxaMkYwWlhkaGVTNWpiMjBpZlEuZXlKbGVIQWlPakUyTWpZNE1UZ3hORGNzSW1wMGFTSTZJakkwTkRjNFpEUTJMVGhtT1RndE5ESmpNaTA1WkRVNUxXTTBOV0ZoWVRCbE1ERTNZeUlzSW5OMVlpSTZJamwyYm5GeE9XYzBjM0pyZDNSeWQzUWlMQ0pwYzNNaU9pSm9kSFJ3Y3pvdkwyRndhUzV6WVc1a1ltOTRMbUp5WVdsdWRISmxaV2RoZEdWM1lYa3VZMjl0SWl3aWJXVnlZMmhoYm5RaU9uc2ljSFZpYkdsalgybGtJam9pT1hadWNYRTVaelJ6Y210M2RISjNkQ0lzSW5abGNtbG1lVjlqWVhKa1gySjVYMlJsWm1GMWJIUWlPbVpoYkhObGZTd2ljbWxuYUhSeklqcGJJbTFoYm1GblpWOTJZWFZzZENKZExDSnpZMjl3WlNJNld5SkNjbUZwYm5SeVpXVTZWbUYxYkhRaVhTd2liM0IwYVc5dWN5STZlMzE5LnNDNGZPdFZpZDVmaUlrZ0ZxV2FyUHhPbW5iNHdvZUV3RkZhWG9BaHkzdXBOOWlQeW5yc3VzN292RFNpR3BEWHVSeW1ZU0xrYmN5WWh1S05fbnJMbjJRIiwiY29uZmlnVXJsIjoiaHR0cHM6Ly9hcGkuc2FuZGJveC5icmFpbnRyZWVnYXRld2F5LmNvbTo0NDMvbWVyY2hhbnRzLzl2bnFxOWc0c3Jrd3Ryd3QvY2xpZW50X2FwaS92MS9jb25maWd1cmF0aW9uIiwiZ3JhcGhRTCI6eyJ1cmwiOiJodHRwczovL3BheW1lbnRzLnNhbmRib3guYnJhaW50cmVlLWFwaS5jb20vZ3JhcGhxbCIsImRhdGUiOiIyMDE4LTA1LTA4IiwiZmVhdHVyZXMiOlsidG9rZW5pemVfY3JlZGl0X2NhcmRzIl19LCJjbGllbnRBcGlVcmwiOiJodHRwczovL2FwaS5zYW5kYm94LmJyYWludHJlZWdhdGV3YXkuY29tOjQ0My9tZXJjaGFudHMvOXZucXE5ZzRzcmt3dHJ3dC9jbGllbnRfYXBpIiwiZW52aXJvbm1lbnQiOiJzYW5kYm94IiwibWVyY2hhbnRJZCI6Ijl2bnFxOWc0c3Jrd3Ryd3QiLCJhc3NldHNVcmwiOiJodHRwczovL2Fzc2V0cy5icmFpbnRyZWVnYXRld2F5LmNvbSIsImF1dGhVcmwiOiJodHRwczovL2F1dGgudmVubW8uc2FuZGJveC5icmFpbnRyZWVnYXRld2F5LmNvbSIsInZlbm1vIjoib2ZmIiwiY2hhbGxlbmdlcyI6W10sInRocmVlRFNlY3VyZUVuYWJsZWQiOnRydWUsImFuYWx5dGljcyI6eyJ1cmwiOiJodHRwczovL29yaWdpbi1hbmFseXRpY3Mtc2FuZC5zYW5kYm94LmJyYWludHJlZS1hcGkuY29tLzl2bnFxOWc0c3Jrd3Ryd3QifSwicGF5cGFsRW5hYmxlZCI6dHJ1ZSwicGF5cGFsIjp7ImJpbGxpbmdBZ3JlZW1lbnRzRW5hYmxlZCI6dHJ1ZSwiZW52aXJvbm1lbnROb05ldHdvcmsiOnRydWUsInVudmV0dGVkTWVyY2hhbnQiOmZhbHNlLCJhbGxvd0h0dHAiOnRydWUsImRpc3BsYXlOYW1lIjoiaHVidXJ0ZGV2IiwiY2xpZW50SWQiOm51bGwsInByaXZhY3lVcmwiOiJodHRwOi8vZXhhbXBsZS5jb20vcHAiLCJ1c2VyQWdyZWVtZW50VXJsIjoiaHR0cDovL2V4YW1wbGUuY29tL3RvcyIsImJhc2VVcmwiOiJodHRwczovL2Fzc2V0cy5icmFpbnRyZWVnYXRld2F5LmNvbSIsImFzc2V0c1VybCI6Imh0dHBzOi8vY2hlY2tvdXQucGF5cGFsLmNvbSIsImRpcmVjdEJhc2VVcmwiOm51bGwsImVudmlyb25tZW50Ijoib2ZmbGluZSIsImJyYWludHJlZUNsaWVudElkIjoibWFzdGVyY2xpZW50MyIsIm1lcmNoYW50QWNjb3VudElkIjoiaHVidXJ0ZGV2IiwiY3VycmVuY3lJc29Db2RlIjoiRVVSIn19",
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
  },
  data() {
    return {
      hostedFieldInstance: false,
      nonce: "",
    };
  },
  methods: {
    payWithCreditCard() {
      if (this.hostedFieldInstance) {
        this.hostedFieldInstance
          .tokenize()
          .then((payload) => {
            console.log(payload);
          })
          .catch((err) => {
            console.error(err);
          });
      }
    },
  },
};

// export default {
//   name: "Checkout",
//   data() {
//     return {
// instance: null,
//   };
// },
// methods: {
// onSuccess(payload) {
//   let nonce = payload.nonce;
//   // Do something great with the nonce...
// },
// onError(error) {
//   let message = error.message;
//   // Whoops, an error has occured while trying to get the nonce
// },
// onLoad(instance) {
//   this.instance = instance;
// },
// onLoadFail(instance) {
//   alert("load fail");
// },
// onSuccess(payload) {
//   console.log("Success!", payload.nonce);
// },
// onError(error) {
//   console.log("Error!", error);
// },
// clearPaymentSelection() {
//   if (this.instance != null) {
//     this.instance.clearSelectedPaymentMethod();
//   }
// },
//   },
// };
</script>

<style scoped lang="scss">
@import "node_modules/bootstrap/scss/bootstrap.scss";

body {
  padding: 20px;
}
</style>
