<template>
  <div
    class="w-full h-full fixed block top-0 left-0 bg-black opacity-75 z-50"
    @click.prevent="$emitter.emit($events.closeSidebar, false)"
    v-show="isSidebarOpen"
  ></div>
</template>

<script>
export default {
  data() {
    return {
      isSidebarOpen: false,
    };
  },

  mounted() {
    this.$emitter.on(this.$events.closeSidebar, (isOpen) => {
      this.isSidebarOpen = isOpen;
      this.$parent._sidebarOpen = this.isSidebarOpen;

      $("body").removeClass("scroll-hide");
      $(".responsive-menu").removeClass("active");
      $(".menu-btn").removeClass("active");
    });

    this.$emitter.on(this.$events.sidebar, () => {
      var status = this.isSidebarOpen;
      this.isSidebarOpen = !status;
      this.$parent._sidebarOpen = this.isSidebarOpen;

      if (status == false) {
        $("body").removeClass("scroll-hide");
        $(".responsive-menu").removeClass("active");
        $(".menu-btn").removeClass("active");
      }
    });
  },
};
</script>
