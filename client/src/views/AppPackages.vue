<template>
  <div>
    <Header class="space-x-16">
      <div class="flex items-center w-96 flex-shrink-0">
        <div class="relative w-full">
          <input
            class="w-full h-12 pl-4 pr-16 font-medium text-sm text-gray-300 bg-gray-800 rounded-lg overflow-hidden transition-all outline-none border-2 border-gray-800 hover:border-pardus-yellow focus:border-pardus-yellow"
            type="text"
            placeholder="Uygulama Paketi Arayın"
            @input="search"
          />
          <IconSearch class="w-6 h-6 text-gray-300 absolute right-3 top-3" />
        </div>
      </div>
      <div>
        <h4 class="text-gray-300 font-medium lg:text-lg">
          Uygulama Paketleriyle
          <span class="text-pardus-yellow font-bold">PARDUS</span>'a Hızlı
          Başlangıç!
        </h4>
      </div>
    </Header>
    <div
      class="grid grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 gap-4 lg:gap-6 2xl:gap-8"
    >
      <div
        v-for="pkg in filteredAppPackages"
        :key="pkg.id"
        class="bg-gray-700 bg-opacity-50 rounded-xl pt-4 pb-10 overflow-hidden relative px-4"
      >
        <button
          class="absolute rounded-tl-lg right-0 bottom-0 px-2 py-2 text-gray-900 bg-pardus-yellow flex items-center"
          v-if="!isInBucket(pkg['pardus_apps'])"
          @click="addToBucket(pkg['pardus_apps'])"
        >
          <span class="font-medium text-sm">Tümünü Sepete Ekle</span>
        </button>
        <span
          class="absolute rounded-tl-lg right-0 bottom-0 bg-green-600"
          v-else
        >
          <IconCheck class="h-8 w-8 text-white" />
        </span>
        <div class="mb-4 flex items-center justify-start">
          <img
            class="object-contain h-12 w-12 mr-4 rounded-full"
            loading="lazy"
            :src="pkg.image_url"
          />
          <h3 class="font-semibold text-gray-100 text-xl flex-1">
            {{ pkg.name }}
          </h3>
        </div>
        <div
          v-for="app in getPardusAppsById(pkg['pardus_apps'])"
          :key="app.id"
          class="bg-gray-700 my-3 px-4 py-3 rounded-lg shadow-md"
        >
          <div class="flex items-center justify-between">
            <div class="flex items-center mr-2">
              <img
                :src="app.image_url"
                loading="lazy"
                class="w-10 h-10 mr-4 rounded-full"
                alt=""
              />
              <span class="text-gray-300 font-medium">{{ app.name }}</span>
            </div>
            <span
              class="text-white bg-green-500 rounded-md px-1 py-1"
              v-if="isInBucket(app.id)"
            >
              <IconCheck class="h-6 w-6" />
            </span>
            <button
              v-else
              class="text-gray-900 bg-pardus-yellow rounded-md px-1 py-1"
              @click="addToBucket(app.id)"
            >
              <IconPlus class="h-6 w-6" />
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import IconSearch from "../icons/icon-search.svg";
import IconCheck from "../icons/icon-check.svg";
import IconPlus from "../icons/icon-plus.svg";
import store from "../global-state/store";
import { ref } from "vue";
import Header from "../components/Header";

export default {
  name: "AlternativeApps",
  components: {
    Header,
    IconSearch,
    IconCheck,
    IconPlus,
  },
  setup() {
    const appPackages = store.appPackages;
    const filteredAppPackages = ref([]);
    filteredAppPackages.value = appPackages.value;

    function search(event) {
      const str = event.target.value;
      filteredAppPackages.value = appPackages.value.filter((pkg) =>
        pkg.name.toLowerCase().includes(str.toLowerCase())
      );
    }

    function getPardusAppsById(pardusAppIds) {
      return store.pardusApps.value.filter((item) =>
        pardusAppIds.includes(item.id)
      );
    }
    return {
      search,
      filteredAppPackages,
      isInBucket: store.isInBucket,
      getPardusAppsById,
      addToBucket: store.addToBucket,
    };
  },
};
</script>

<style scoped></style>
