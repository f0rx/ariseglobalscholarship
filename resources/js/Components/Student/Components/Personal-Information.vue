<template>
  <form
    class="px-6 py-6 md:px-4 md:pt-5 bg-white space-y-4 h-screen overflow-y-auto no-scrollbar"
    :class="`border-indigo-500 border-solid border-t md:border-transparent md:border-none`"
    @submit.prevent="createOrUpdate"
  >
    <create-page-subtitle> Basic Personal Information </create-page-subtitle>
    <!--  -->
    <div class="grid grid-cols-12 gap-3">
      <div class="col-span-12 sm:col-span-6 md:col-span-4">
        <label for="first_name" class="block text-sm font-medium text-gray-700"
          >First Name</label
        >
        <input-field
          v-model:firstName.trim.capitalize="form.firstName"
          :value="form.firstName"
          name="first_name"
          id="first_name"
          autocomplete="given-name"
          model-name="firstName"
          required
        />
      </div>

      <div class="col-span-12 sm:col-span-6 md:col-span-4">
        <label for="last_name" class="block text-sm font-medium text-gray-700"
          >Surname</label
        >

        <input-field
          v-model:lastName.trim.capitalize="form.lastName"
          :value="form.lastName"
          name="last_name"
          id="last_name"
          autocomplete="family-name"
          model-name="lastName"
          required
        />
      </div>

      <div class="col-span-12 sm:col-span-6 md:col-span-4">
        <label for="other_names" class="block text-sm font-medium text-gray-700"
          >Other Names</label
        >

        <input-field
          v-model:otherNames.trim.capitalize="form.otherNames"
          :value="form.otherNames"
          name="other_names"
          id="other_names"
          autocomplete="given-name"
          model-name="otherNames"
        />
      </div>

      <div class="col-span-12 sm:col-span-7 md:col-span-6">
        <label
          for="email_address"
          class="block text-sm font-medium text-gray-700"
          >Email address</label
        >
        <input-field
          v-model:email.trim.no-whitespace="form.email"
          :value="form.email"
          name="email_address"
          id="email_address"
          autocomplete="email"
          model-name="email"
          class="opacity-70 bg-gray-300 cursor-not-allowed"
          disabled
          aria-disabled=""
        />
      </div>

      <div class="col-span-12 sm:col-span-5 md:col-span-6">
        <label
          for="phone_number"
          class="block text-sm font-medium text-gray-700"
          >Mobile Number</label
        >
        <div class="mt-1 flex rounded-md shadow-sm">
          <span
            class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm"
          >
            +234
          </span>

          <input-field
            v-model:phone.unmask-phone.no-whitespace="form.phone"
            :value="form.phone"
            model-name="phone"
            clazz="text-gray-700 focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300"
            type="tel"
            name="phone"
            id="phone_number"
            autocomplete="phone"
            pattern="\([0-9]{3}\) [0-9]{3} [0-9]{4}"
            maxlength="14"
            v-mask="'(###) ### ####'"
            required
          />
        </div>
      </div>
    </div>

    <div class="grid grid-cols-12 gap-3">
      <div class="col-span-12 sm:col-span-4 md:col-span-4 lg:col-span-4">
        <label
          for="dob"
          class="block text-sm font-medium text-gray-700"
          v-if="!$detector.isSafari"
          >Date of Birth</label
        >

        <input-field
          v-model:dob="form.dob"
          :value="form.dob"
          model-name="dob"
          v-if="!$detector.isSafari"
          type="date"
          name="dob"
          id="dob"
          autocomplete="birthday"
          pattern="\d{4}-\d{2}-\d{2}"
          required
        />

        <!--  -->

        <label
          for="age"
          class="block text-sm font-medium text-gray-700"
          v-if="$detector.isSafari"
          >Age</label
        >
        <span v-if="$detector.isSafari"
          ><select
            id="age"
            name="age"
            class="w-full border bg-white rounded-md px-3 py-2 text-gray-700 outline-none"
            aria-required=""
            v-model="form.age"
            required
          >
            <option selected :value="null" disabled>
              -- Select your age --
            </option>
            <option
              v-for="age in 100"
              :key="age"
              :value="age"
              v-show="age > 20"
              v-text="age"
            ></option></select
        ></span>
      </div>

      <div class="col-span-12 sm:col-span-3 md:col-span-4 lg:col-span-3 block">
        <label class="text-sm font-medium text-gray-700">Gender</label>

        <div class="grid grid-cols-12 gap-2">
          <div class="col-span-6 sm:col-span-6 md:col-span-6 inline-flex h-10">
            <input
              id="male"
              name="gender"
              type="radio"
              class="focus:ring-main-400 self-center h-4 w-4 text-main-600 border-gray-300"
              value="male"
              @input="form.gender = $event.target.value"
              :checked="form.gender == 'male'"
              required
            />

            <label for="male" class="flex h-full items-center">
              <span class="ml-2 self-center text-sm font-medium text-gray-700"
                >Male</span
              >
            </label>
          </div>
          <!--  -->
          <div class="col-span-6 sm:col-span-6 md:col-span-6 inline-flex h-10">
            <input
              id="female"
              name="gender"
              type="radio"
              class="focus:ring-main-400 self-center h-4 w-4 text-main-600 border-gray-300"
              value="female"
              @input="form.gender = $event.target.value"
              :checked="form.gender == 'female'"
              required
            />

            <label for="female" class="flex h-full items-center">
              <span class="ml-2 self-center text-sm font-medium text-gray-700"
                >Female</span
              >
            </label>
          </div>
          <!--  -->
        </div>
      </div>

      <div
        class="col-span-12 sm:col-span-5 md:col-span-4 lg:col-span-5 relative"
      >
        <label for="marital_status" class="text-sm font-medium text-gray-700"
          >Marital Status</label
        >
        <select-component
          :options="['Single', 'Married', 'Divorced', 'Widowed', 'Seperated']"
          :value="form.maritalStatus"
          @selection-changed-event="form.maritalStatus = $event"
        ></select-component>
      </div>
    </div>

    <!--  -->

    <hr />
    <br class="md:block" />

    <create-page-subtitle> Residential Details </create-page-subtitle>

    <div class="grid grid-cols-12 gap-3">
      <div class="col-span-12 sm:col-span-7 md:col-span-7">
        <label
          for="home_address"
          class="block text-sm font-medium text-gray-700"
        >
          Street Address
        </label>

        <div class="mt-1">
          <textarea
            id="home_address"
            name="home_address"
            rows="3"
            class="text-gray-700 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border-gray-300 rounded-md"
            placeholder="No 36. Melburn Street"
            v-model="form.address"
          ></textarea>
        </div>
        <!-- <p class="mt-2 text-sm text-gray-500">
        Brief description for your profile. URLs are hyperlinked.
      </p> -->
      </div>
    </div>

    <div class="grid grid-cols-12 gap-2 md:gap-2 lg:gap-3 xl:gap-3">
      <div class="col-span-12 md:col-span-3 lg:col-span-3 relative self-end">
        <label for="country" class="text-sm font-medium text-gray-700"
          >Country / Region</label
        >
        <select-component
          :options="['Nigeria']"
          :value="form.country"
          @selection-changed-event="form.country = $event"
          select-first
        />
      </div>

      <div class="col-span-12 md:col-span-3 lg:col-span-3 relative self-end">
        <label for="state" class="text-sm font-medium text-gray-700"
          >State / Province</label
        >
        <select-component
          :options="states"
          :value="form.state"
          @selection-changed-event="form.state = $event"
          positioned
        />
      </div>

      <div class="col-span-12 md:col-span-3 lg:col-span-3 relative self-end">
        <label for="local_govt" class="text-sm font-medium text-gray-700"
          >Local Govt. of Residence</label
        >
        <select-component
          :options="localGovtAreas"
          :value="form.localGovtArea"
          @selection-changed-event="localGovtAreaField = $event"
          positioned
        />
      </div>

      <div class="col-span-12 md:col-span-3 lg:col-span-3 self-end">
        <label for="city" class="block text-sm font-medium text-gray-700"
          >City</label
        >
        <input-field
          v-model:city.capitalize="form.city"
          :value="form.city"
          model-name="city"
          class="text-gray-700 mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
          type="text"
          name="city"
          id="city"
          autocomplete="city"
        />
      </div>
    </div>

    <slot name="footer"></slot>
  </form>
</template>

<script>
const COUNTRY_CODE = "234";

export default {
  inject: ["user", "program"],

  data() {
    return {
      states: this.$Province.getStates().names,
      localGovtAreas: [],
      errors: {},
      form: this.$inertia.form(`UpdatePersonalInfo:${this.user.id}`, {
        firstName: this.user.first_name,
        lastName: this.user.last_name,
        otherNames: this.user.scholarship.other_names,
        email: this.user.email,
        phone: this.user.scholarship.phone?.replace(COUNTRY_CODE, ""),
        dob: this.$moment(this.user.scholarship.dob).format("YYYY-MM-DD"),
        age: this.user.scholarship.age,
        gender: this.user.scholarship.gender,
        maritalStatus: this.user.scholarship.marital_status,
        address: this.user.scholarship.address_street,
        country: this.user.scholarship.address_country,
        state: this.user.scholarship.address_state,
        localGovtArea: this.user.scholarship.address_lga,
        city: this.user.scholarship.address_city,
      }),
    };
  },

  methods: {
    createOrUpdate() {
      this.form
        .transform((data) => ({
          ...data,
          phone: `+${COUNTRY_CODE}${data.phone}`,
          age: data.dob ? this.$calculateAge(data.dob) : data.age,
        }))
        .put(
          this.route(`scholarship.update`, {
            user: this.user,
            program: this.program,
          }),
          {
            onSuccess: () => {
              // Set errors to empty obj
              this.errors = {};
              // Fire Success Toast
              this.$toast.fire({
                icon: "success",
                title: "Updated successfully!",
              });
            },
            onError: (errors) => {
              // Set errors
              this.errors = errors;
              // Loop thru errors and show Swal
              for (const err in errors) {
                // Fire Error Toast
                this.$toast.fire({
                  icon: "error",
                  title: errors[err],
                });
              }
            },
            onFinish: () => {
              // If errors object is empty, switch tab
              if (this.$isEmptyObject(this.errors))
                this.$emitter.emit(this.$events.switchNextTab);
            },
          }
        );
    },

    populateLocalGovtAreas() {
      this.localGovtAreas = this.$Province
        .getLocalGovt(this.form.state)
        .map((v) => v.name);
    },
  },

  watch: {
    "form.state"() {
      try {
        this.populateLocalGovtAreas();
      } catch (_) {
        return [];
      }
    },
  },

  computed: {
    localGovtAreaField: {
      get() {
        return this.form.localGovtArea;
      },
      set(val) {
        if (!this.localGovtAreas.length) this.populateLocalGovtAreas();
        this.form.localGovtArea = val;
      },
    },
  },
};
</script>
