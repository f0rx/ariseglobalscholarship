<template>
  <div class="main-section">
    <background-component />

    <div
      class="min-h-screen flex flex-col sm:justify-center items-center pt-6 px-6 md:px-0 sm:pt-2"
    >
      <div>
        <a :href="route('/')">
          <breeze-application-logo
            class="w-20 h-20 fill-current text-gray-500"
          />
        </a>
      </div>

      <div
        class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg"
      >
        <slot />
      </div>
    </div>
  </div>
</template>

<script>
import BreezeApplicationLogo from "@/Components/ApplicationLogo";

export default {
  components: {
    BreezeApplicationLogo,
  },
};
</script>
