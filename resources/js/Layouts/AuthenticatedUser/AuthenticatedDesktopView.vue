<template>
  <div class="max-w-7xl mx-auto px-5 md:px-6 lg:px-8 py-2">
    <div
      class="grid grid-cols-12 gap-2 md:flex items-center justify-between h-16 md:h-auto"
    >
      <div class="col-span-4 -mr-2 flex md:hidden">
        <button
          type="button"
          class="bg-gray-800 inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white"
          aria-controls="mobile-menu"
          aria-expanded="false"
          @click.prevent="
            $emitter.emit(
              $events.toggleDashboardMenu,
              !$parent.showingNavigationDropdown
            )
          "
        >
          <span class="sr-only">Open main menu</span>

          <svg
            class="h-6 w-6"
            :class="{
              block: !$parent.showingNavigationDropdown,
              hidden: $parent.showingNavigationDropdown,
            }"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
            aria-hidden="true"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M4 6h16M4 12h16M4 18h16"
            />
          </svg>
          <svg
            class="h-6 w-6"
            :class="{
              block: $parent.showingNavigationDropdown,
              hidden: !$parent.showingNavigationDropdown,
            }"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
            aria-hidden="true"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M6 18L18 6M6 6l12 12"
            />
          </svg>
        </button>
      </div>

      <div
        class="col-span-4 md:flex place-self-center justify-self-center justify-center"
      >
        <div class="flex-shrink-0">
          <a :href="route('/')">
            <breeze-application-logo class="block h-16 md:h-10 w-auto" />
          </a>
        </div>

        <div class="hidden md:block h-16 md:h-10">
          <div
            class="ml-10 flex space-x-4 items-center content-center justify-center justify-self-center"
          >
            <inertia-link
              class="px-3 py-2.5 rounded-md text-sm font-medium"
              v-for="(desktopMenu, index) in desktopMenus"
              :key="index"
              :href="
                desktopMenu.param == null
                  ? route(desktopMenu.name)
                  : route(desktopMenu.name, desktopMenu.param)
              "
              :title="desktopMenu.title"
              v-text="desktopMenu.title"
              :class="{
                'bg-gray-900 text-white': route().current(desktopMenu.name),
                'text-gray-300 hover:bg-gray-700 hover:text-white': !route().current(
                  desktopMenu.name
                ),
              }"
            ></inertia-link>
          </div>
        </div>
      </div>

      <div
        class="col-span-4 -mr-2 flex md:hidden justify-self-end"
        v-show="route().current('scholarship.apply')"
      >
        <button
          type="button"
          class="bg-gray-800 inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white"
          aria-controls="mobile-menu"
          aria-expanded="false"
          @click.prevent="
            $emitter.emit(
              $events.toggleDashboardTabMenu,
              !$parent.showingTabMenuDropdown
            )
          "
        >
          <span class="sr-only">Open tab menu</span>

          <svg
            :class="{
              block: !$parent.showingTabMenuDropdown,
              hidden: $parent.showingTabMenuDropdown,
            }"
            class="h-8 w-8 text-white"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 32 32"
            fill="currentColor"
            aria-hidden="true"
          >
            <path
              fill-rule="evenodd"
              d="M16.003 18.626l7.081-7.081L25 13.46l-8.997 8.998-9.003-9 1.917-1.916z"
              clip-rule="evenodd"
            />
          </svg>

          <svg
            :class="{
              block: $parent.showingTabMenuDropdown,
              hidden: !$parent.showingTabMenuDropdown,
            }"
            class="h-8 w-8 text-white"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 32 32"
            fill="currentColor"
            aria-hidden="true"
          >
            <path
              fill-rule="evenodd"
              d="M15.997 13.374l-7.081 7.081L7 18.54l8.997-8.998 9.003 9-1.916 1.916z"
              clip-rule="evenodd"
            />
          </svg>
        </button>
      </div>

      <!-- Show only on desktop -->
      <div class="hidden md:block">
        <div class="ml-4 flex items-center md:ml-6">
          <button
            class="bg-gray-800 p-1 rounded-full text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white"
          >
            <span class="sr-only">View notifications</span>
            <!-- Heroicon name: outline/bell -->
            <svg
              class="h-6 w-6"
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
              aria-hidden="true"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"
              />
            </svg>
          </button>

          <!-- Profile dropdown -->
          <div class="ml-3 relative">
            <div>
              <a
                type="button"
                class="max-w-xs bg-gray-800 rounded-full flex items-center text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white"
                id="user-menu"
                href="#"
                aria-expanded="false"
                aria-haspopup="true"
                @click.prevent="
                  $emitter.emit(
                    $events.toggleDashboardMenu,
                    !$parent.showingNavigationDropdown
                  )
                "
              >
                <span class="sr-only">Open user menu</span>
                <img
                  class="h-10 w-10 rounded-full"
                  :src="`${$asset_url}/user.png`"
                  :alt="user.first_name"
                />
              </a>
            </div>

            <div
              class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-10"
              role="menu"
              aria-orientation="vertical"
              aria-labelledby="user-menu"
              :class="{
                block: $parent.showingNavigationDropdown,
                hidden: !$parent.showingNavigationDropdown,
              }"
            >
              <inertia-link
                href="#"
                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                role="menuitem"
                >Your Profile</inertia-link
              >

              <inertia-link
                href="#"
                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                role="menuitem"
                >Edit Profile</inertia-link
              >

              <a
                :href="route('logout')"
                @click.prevent="$parent.submit"
                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                role="menuitem"
              >
                <form method="POST" :action="route('logout')">Log out</form>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import BreezeApplicationLogo from "@/Components/ApplicationLogo";
import BreezeResponsiveNavLink from "@/Components/ResponsiveNavLink";

export default {
  inject: ["user", "program"],

  components: {
    BreezeApplicationLogo,
    BreezeResponsiveNavLink,
  },

  data() {
    return {
      desktopMenus: [
        {
          title: "Dashboard",
          name: "dashboard",
          param: null,
        },

        {
          title: "Apply for Scholarship",
          name: "scholarship.apply",
          param: null,
        },

        {
          title: "Application Status",
          name: "scholarship./",
          param: {
            // user: this.user,
            program: this.program ?? "",
          },
        },
      ],
    };
  },
};
</script>
