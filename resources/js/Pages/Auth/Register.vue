<template>
  <title-component after="Sign Up"></title-component>

  <breeze-validation-errors class="mb-4" />

  <form @submit.prevent="submit">
    <div>
      <breeze-label for="name" value="Name" />
      <breeze-input
        id="name"
        type="text"
        name="name"
        class="mt-1 block w-full"
        v-model="form.name"
        required
        autofocus
        autocomplete="name"
      />
    </div>

    <div class="mt-4">
      <breeze-label for="email" value="Email" />
      <breeze-input
        id="email"
        type="email"
        name="email"
        class="mt-1 block w-full"
        v-model="form.email"
        required
        autocomplete="email"
      />
    </div>

    <div class="mt-4">
      <breeze-label for="phone" value="Phone Number" />
      <breeze-input
        id="phone"
        name="phone"
        type="text"
        maxlength="11"
        class="mt-1 block w-full"
        v-model="form.phone"
        required
        autocomplete="phone"
      />
    </div>

    <div class="mt-4">
      <breeze-label for="password" value="Password" />
      <breeze-input
        id="password"
        type="password"
        name="password"
        class="mt-1 block w-full"
        v-model="form.password"
        required
        autocomplete="new-password"
      />
    </div>

    <div class="mt-4">
      <breeze-label for="password_confirmation" value="Confirm Password" />
      <breeze-input
        id="password_confirmation"
        type="password"
        class="mt-1 block w-full"
        v-model="form.password_confirmation"
        required
        autocomplete="new-password"
      />
    </div>

    <div class="flex items-center justify-end mt-4">
      <inertia-link
        :href="route('login')"
        class="underline text-sm text-gray-600 hover:text-gray-900 mr-3"
        replace
        preserve-scroll
        preserve-state
      >
        Already registered?
      </inertia-link>

      <breeze-button
        class="bg-main-600 hover:bg-main-800 hover:shadow-lg hover:text-main"
        :class="{ 'opacity-25': form.processing }"
        :disabled="form.processing"
      >
        Register
      </breeze-button>
    </div>
  </form>
</template>

<script>
import BreezeButton from "@/Components/Button";
import BreezeCheckbox from "@/Components/Checkbox";
import BreezeGuestLayout from "@/Layouts/Guest";
import BreezeInput from "@/Components/Input";
import BreezeLabel from "@/Components/Label";
import BreezeValidationErrors from "@/Components/ValidationErrors";

export default {
  layout: BreezeGuestLayout,

  components: {
    BreezeButton,
    BreezeCheckbox,
    BreezeInput,
    BreezeLabel,
    BreezeValidationErrors,
  },

  data() {
    return {
      form: this.$inertia.form({
        name: "",
        email: "",
        phone: "",
        password: "",
        password_confirmation: "",
        terms: false,
      }),
    };
  },

  methods: {
    submit() {
      this.form.post(this.route("register"), {
        onFinish: () => this.form.reset("password", "password_confirmation"),
      });
    },
  },
};
</script>
