<template>
  <article
    tabindex="0"
    class="group hasImage w-full h-full rounded-md focus:outline-none focus:shadow-outline bg-gray-100 cursor-pointer relative text-transparent hover:text-white shadow-sm"
    v-if="file.isImage"
  >
    <img
      class="img-preview w-full h-full sticky object-scale-down rounded-md bg-fixed opacity-60"
      :src="`${file.url}`"
      :alt="file.bame"
    />

    <section
      class="flex flex-col rounded-md text-xs break-words w-full h-full z-20 absolute top-0 py-2 px-3"
    >
      <h1
        class="flex-1 text-black"
        v-show="!downloadable"
        v-text="file.name"
      ></h1>

      <a
        :href="`${$documents_url}/${user?.first_name?.toLowerCase()}/${
          file?.name
        }`"
        v-show="downloadable"
        class="flex-1 text-black hover:text-main-600 hover:underline"
        v-text="file.name"
      ></a>

      <div class="flex text-gray-800">
        <span class="p-1">
          <i>
            <svg
              class="fill-current w-4 h-4 ml-auto pt-"
              xmlns="http://www.w3.org/2000/svg"
              width="24"
              height="24"
              viewBox="0 0 24 24"
            >
              <path
                d="M5 8.5c0-.828.672-1.5 1.5-1.5s1.5.672 1.5 1.5c0 .829-.672 1.5-1.5 1.5s-1.5-.671-1.5-1.5zm9 .5l-2.519 4-2.481-1.96-4 5.96h14l-5-8zm8-4v14h-20v-14h20zm2-2h-24v18h24v-18z"
              />
            </svg>
          </i>
        </span>

        <p class="p-1 size text-xs text-black" v-text="file.size"></p>

        <button
          class="delete ml-auto focus:outline-none hover:bg-gray-300 p-1 rounded-md"
          @click.prevent="$emit('delete-file', file)"
        >
          <svg
            class="pointer-events-none fill-current w-4 h-4 ml-auto"
            xmlns="http://www.w3.org/2000/svg"
            width="24"
            height="24"
            viewBox="0 0 24 24"
          >
            <path
              class="pointer-events-none"
              d="M3 6l3 18h12l3-18h-18zm19-4v2h-20v-2h5.711c.9 0 1.631-1.099 1.631-2h5.316c0 .901.73 2 1.631 2h5.711z"
            />
          </svg>
        </button>
      </div>
    </section>
  </article>
</template>

<script>
export default {
  inject: ["user"],

  props: {
    file: Object,
    mimes: Object,
    downloadable: Boolean,
  },

  emits: ["delete-file"],
};
</script>
