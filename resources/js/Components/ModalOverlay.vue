<template>
  <transition
    enter-class="opacity-0"
    enter-from-class="opacity-0"
    enter-to-class="opacity-100"
    leave-class="opacity-100"
    leave-from-class="opacity-100"
    leave-to-class="opacity-0"
  >
    <div
      class="fixed z-50 inset-0 overflow-y-auto"
      aria-labelledby="modal-title"
      role="dialog"
      aria-modal="true"
      v-show="_showModal"
    >
      <div
        class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0"
      >
        <div
          class="fixed inset-0 bg-gray-400 bg-opacity-75 transition-opacity"
          aria-hidden="true"
          @click="dismissible ? (_showModal = false) : null"
        />

        <span
          class="hidden sm:inline-block sm:align-middle sm:h-screen"
          aria-hidden="true"
          >&#8203;</span
        >

        <transition
          enter-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
          enter-from-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
          enter-to-class="opacity-100 translate-y-0 sm:scale-100"
          leave-class="opacity-100 translate-y-0 sm:scale-100"
          leave-from-class="opacity-100 translate-y-0 sm:scale-100"
          leave-to-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        >
          <slot></slot>
        </transition>
      </div>
    </div>
  </transition>
</template>

<script>
export default {
  data() {
    return {
      _showModal: false,
    };
  },

  props: {
    modalId: String,
    dismissible: {
      type: Boolean,
      required: false,
      default: () => true,
    },
  },

  mounted() {
    this.$emitter.on(this.$events.closeModal, (id) => {
      if (this.modalId == id) {
        this._showModal = false;
      }
    });
    this.$emitter.on(this.$events.openModal, (id) => {
      if (this.modalId == id) this._showModal = true;
    });
  },
};
</script>
