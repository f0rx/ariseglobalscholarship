<template>
  <title-component after="Mailable"></title-component>

  <div>
    <teleport to="body">
      <modal-overlay modal-id="mailer" :dismissible="false">
        <modal class="h-50" modal-id="mailer">
          <!--  -->
          <template #modal_header>
            <h3
              class="text-lg leading-6 font-medium text-gray-900"
              id="modal-title"
            >
              Choose Applicants to receive Mailable
            </h3>
          </template>
          <!--  -->
          <template #modal_body>
            <Multiselect
              v-model="form.emails"
              mode="tags"
              :searchable="true"
              :createTag="true"
              placeholder="Search applicants by name..."
              :options="applicants"
              noResultsText="No user found"
            >
              <template v-slot:multiplelabel="{ values }">
                <div class="multiselect-multiple-label">
                  {{ values.length }} user selected
                </div>
              </template></Multiselect
            >

            <div class="col-span-12 md:auto-cols-min mt-6">
              <div class="flex flex-grow-0 space-x-2">
                <label
                  for="selectAll"
                  class="inline-flex text-sm font-medium text-gray-700"
                  >All Applicants
                </label>

                <input
                  class="inline-flex self-end rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                  :class="`w-5 h-5 md:w-4 md:h-4 cursor-pointer`"
                  type="checkbox"
                  name="selectAll"
                  id="selectAll"
                  v-model="selectedAll"
                />
              </div>
            </div>
          </template>

          <template #modal_ok>
            <button
              type="button"
              :disabled="noEmailSelected"
              :class="{ 'opacity-25': noEmailSelected }"
              :title="
                noEmailSelected
                  ? 'Select at least 1 applicant to proceed!'
                  : 'Click to continue.'
              "
              class="sm:mt-0 mt-3 w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm"
              @click.prevent="next"
            >
              Next
            </button>
          </template>
        </modal>
      </modal-overlay>
    </teleport>
  </div>

  <div>
    <teleport to="body">
      <modal-overlay modal-id="composer" :dismissible="!form.processing">
        <modal class="h-200" modal-id="composer">
          <!--  -->
          <template #modal_header>
            <h3
              class="text-lg leading-6 font-medium text-gray-900"
              id="modal-title"
            >
              Compose Mail
            </h3>
          </template>
          <!--  -->
          <template #modal_body>
            <div class="grid grid-cols-12 gap-3 mt-8 sm:mt-6">
              <div class="col-span-12 md:col-span-7">
                <label
                  for="subject"
                  class="block text-sm font-medium text-gray-700 text-justify"
                  >Email Subject</label
                >
                <input-field
                  v-model:subject.capitalize="form.subject"
                  :value="form.subject"
                  name="subject"
                  id="subject"
                  model-name="subject"
                  required
                />
              </div>

              <div class="col-span-12">
                <label
                  for="message"
                  class="block text-sm font-medium text-gray-700 text-justify"
                  >Message</label
                >
                <textarea
                  v-model="form.message"
                  name="message"
                  id="message"
                  cols="30"
                  rows="6"
                  class="text-gray-700 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border-gray-300 rounded-md"
                  placeholder="Congratulations! You've..."
                ></textarea>
              </div>
            </div>

            <div class="col-span-12 md:auto-cols-min mt-6">
              <div class="flex flex-grow-0 space-x-2">
                <label
                  for="hasActionButton"
                  class="inline-flex text-sm font-medium text-gray-700"
                  >Insert Action Button?
                </label>

                <input
                  class="inline-flex self-end rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                  :class="`w-5 h-5 md:w-4 md:h-4 cursor-pointer`"
                  type="checkbox"
                  name="hasActionButton"
                  id="hasActionButton"
                  v-model="form.hasActionButton"
                />
              </div>
            </div>
          </template>

          <template #modal_cancel>
            <button
              type="button"
              @click="$emitter.emit($events.closeModal, 'composer')"
              class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
              :class="{ 'opacity-25': form.processing }"
              :disabled="form.processing"
            >
              Close
            </button>
          </template>

          <template #modal_ok>
            <button
              type="button"
              class="sm:mt-0 mt-3 w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm"
              @click.prevent="send"
              :class="{ 'opacity-25': form.processing }"
              :disabled="form.processing"
            >
              Send
            </button>
          </template>
        </modal>
      </modal-overlay>
    </teleport>
  </div>
</template>

<script>
import Multiselect from "@vueform/multiselect";

export default {
  data() {
    return {
      selectedAll: false,
      errors: {},
      applicants: [],
      form: this.$inertia.form({
        emails: [],
        subject: null,
        message: null,
        hasActionButton: false,
      }),
    };
  },

  computed: {
    noEmailSelected() {
      return !this.form.emails || !this.form.emails.length;
    },
  },

  watch: {
    selectedAll() {
      if (this.selectedAll)
        this.form.emails = this.$attrs.applicants.map((e) => e.email);
      else this.form.emails = [];
    },
  },

  methods: {
    next() {
      if (!this.form.emails?.length) {
        this.$toast.fire({
          icon: "error",
          title: "Please select at least 1 email address!",
        });
        return;
      }

      this.$emitter.emit(this.$events.openModal, "composer");
    },

    async filterOptions(query) {
      return typeof query === "undefined" || query == null
        ? this.applicants
        : this.applicants.filter((i) =>
            i.label.toLowerCase().includes(query.toLowerCase())
          );
    },

    send() {
      this.form
        .transform((data) => ({
          ...data,
        }))
        .post(this.route(`mail.store`), {
          onSuccess: () => {
            // Set errors to empty obj
            this.errors = {};
            // Fire Success Toast
            this.$toast.fire({
              icon: "success",
              title: "Emails have been dispatched to Queue.",
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
            console.log("Email sent successfully!");
          },
        });
    },
  },

  provide() {
    return {
      applicants: this.$attrs.applicants,
    };
  },

  components: {
    Multiselect,
  },

  mounted() {
    this.$emitter.emit(this.$events.openModal, "mailer");
  },

  created() {
    this.applicants = this.$attrs.applicants.map((e) => ({
      value: e.email,
      label: e.name,
    }));
  },
};
</script>

<style src="@vueform/multiselect/themes/default.css"></style>
