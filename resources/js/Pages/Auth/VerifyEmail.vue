<template>
  <title-component after="Verify E-mail"></title-component>

  <div class="mb-4 text-sm text-gray-600">
    Thanks for signing up! Before getting started, could you verify your email
    address by clicking on the link we just emailed to you? If you didn't
    receive the email, we will gladly send you another.
  </div>

  <div class="mb-2">
    <em class="text-gray-500 text-sm"
      >PS: You may need to check your Spam folder!</em
    >
  </div>

  <div
    class="mb-4 font-medium text-sm text-green-600"
    v-if="verificationLinkSent"
  >
    A new verification link has been sent to the email address you provided
    during registration.
  </div>

  <form @submit.prevent="submit">
    <div class="mt-4 flex items-center justify-between">
      <breeze-button
        class="bg-gray-800 hover:bg-gray-700"
        :class="{ 'opacity-25': form.processing }"
        :disabled="form.processing"
      >
        Resend Verification Email
      </breeze-button>

      <inertia-link
        :href="route('logout')"
        method="post"
        as="button"
        class="underline text-sm text-gray-600 hover:text-gray-900"
        >Log Out</inertia-link
      >
    </div>
  </form>
</template>

<script>
import BreezeButton from "@/Components/Button";
import BreezeGuestLayout from "@/Layouts/Guest";

export default {
  layout: BreezeGuestLayout,

  components: {
    BreezeButton,
  },

  props: {
    status: String,
  },

  data() {
    return {
      form: this.$inertia.form(),
    };
  },

  methods: {
    submit() {
      this.form.post(this.route("verification.send"));
    },
  },

  computed: {
    verificationLinkSent() {
      return this.status === "verification-link-sent";
    },
  },
};
</script>
