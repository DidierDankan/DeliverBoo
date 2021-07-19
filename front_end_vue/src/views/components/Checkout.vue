<template>
  <div>
    <form
      ref="payment-form"
      id="payment-form"
      action="/route/on/your/server"
      method="post"
      @submit.prevent="getClientToken()"
    >
      <!-- Putting the empty container you plan to pass to
      `braintree.dropin.create` inside a form will make layout and flow
      easier to manage -->
      <div ref="dropin-container" id="dropin-container"></div>
      <input type="submit" />
      <input type="hidden" ref="nonce" id="nonce" name="payment_method_nonce" />
    </form>
  </div>
</template>

<script>
import braintree from "braintree";

export default {
  name: "Checkout",

  methods: {
    getClientToken() {
      const form = this.$refs["payment-form"];

      braintree.dropin.create(
        {
          authorization: CLIENT_TOKEN_FROM_SERVER,
          container: this.$refs["container"],
          // ...plus remaining configuration
        },
        (error, dropinInstance) => {
          if (error) console.error(error);

          dropinInstance.requestPaymentMethod((error, payload) => {
            if (error) console.error(error);

            // Step four: when the user is ready to complete their
            //   transaction, use the dropinInstance to get a payment
            //   method nonce for the user's selected payment method, then add
            //   it a the hidden field before submitting the complete form to
            //   a server-side integration
            this.$refs["nonce"].value = payload.nonce;
            form.submit();
          });
          // Use `dropinInstance` here
          // Methods documented at https://braintree.github.io/braintree-web-drop-in/docs/current/Dropin.html
        }
      );
    },
  },
};
</script>

<style scoped lang="scss"></style>
