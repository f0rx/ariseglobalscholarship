<template>
  <button
    @click.prevent="toggle"
    v-click-outside="close"
    type="button"
    aria-haspopup="listbox"
    aria-expanded="true"
    aria-labelledby="listbox-label"
    class="relative w-full bg-white border border-gray-300 rounded-lg shadow-sm pl-3 pr-8 py-2"
    :class="`text-left cursor-default focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm`"
  >
    <span class="flex items-center text-gray-700">
      <span class="block truncate" v-text="selected"> </span>
    </span>

    <!-- <input type="text" v-model="value.localGovtArea" /> -->

    <span
      class="ml-3 absolute inset-y-0 right-0 flex items-center pr-1 pointer-events-none"
    >
      <svg
        class="h-5 w-5 text-gray-700"
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 20 20"
        fill="currentColor"
        aria-hidden="true"
      >
        <path
          fill-rule="evenodd"
          d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
          clip-rule="evenodd"
        />
      </svg>
    </span>
  </button>

  <!-- BOTTOM Dropdown starts here -->
  <select-dropdown-component
    :should-hide="!isDropdownVisible"
    :items="items"
    :position="positioned"
  />
</template>

<script>
const DEFAULT = "--  Select  --";

export default {
  data() {
    return {
      isDropdownVisible: false,
      items: [],
    };
  },

  emits: {
    "selection-changed-event"(value) {
      return (
        typeof value !== "undefined" &&
        typeof value === "string" &&
        value.length
      );
    },
  },

  computed: {
    selected() {
      let initial = { value: DEFAULT };

      return typeof this.items == "undefined" ||
        this.items == null ||
        !this.items.length
        ? initial.value
        : (this.items.find((e) => e.isSelected) || initial).value;
    },
  },

  watch: {
    selected() {
      this.$emit(this.$events.onSelectionChanged, this.selected);
    },

    // value() {
    //   this.$emit(this.$events.onSelectionChanged, this.selected);
    // },

    options() {
      this.mapOptionsToItems();
    },
  },

  props: {
    selectFirst: {
      type: Boolean,
      required: false,
      default: () => false,
    },

    value: {
      type: String,
      required: true,
    },

    options: {
      type: Array,
      required: true,
      default: () => [],
    },

    positioned: {
      type: Boolean,
      required: false,
      default: () => false,
    },
  },

  methods: {
    mapOptionsToItems() {
      this.items = this.options.map((i) => ({
        value: i,
        isSelected: this.selectFirst ? this.options[0] == i : this.value == i,
      }));
    },
    toggle() {
      this.isDropdownVisible = !this.isDropdownVisible;
      //   if (this.isDropdownVisible)
      //     this.$emitter.emit(this.$events.toggleFullOverlay, {
      //       //   background: "bg-transparent",
      //       zIndex: "z-30",
      //     });
    },
    close() {
      this.isDropdownVisible = false;
    },
  },

  mounted() {
    if (this.options && this.options.length) {
      this.mapOptionsToItems();
    }

    if (this.value && !this.value.includes(DEFAULT)) {
      this.$emit(this.$events.onSelectionChanged, this.value);
    }
  },
};
</script>
