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
        class="bg-gray-700 bg-opacity-50 rounded-xl shadow-xg pt-4 pb-8 overflow-hidden relative"
      >
        <button
          class="absolute rounded-tl-lg right-0 bottom-0 px-2 py-2 text-gray-900 bg-pardus-yellow flex items-center"
          v-if="!isInBucket(pkg['pardus_apps'])"
          @click="addToBucket(pkg['pardus_apps'])"
        >
          <IconPlus class="w-4 h-4" />
          <span class="font-medium text-sm">Sepete Ekle</span>
        </button>
        <span
          class="absolute rounded-tl-lg right-0 bottom-0 bg-green-600"
          v-else
        >
          <IconCheck class="h-12 w-12 text-white" />
        </span>
        <div class="mb-4">
          <img class="w-full object-contain h-24" :src="pkg.image_url" />
          <h3 class="font-medium text-gray-200 mx-4 text-xl mt-4">
            {{ pkg.name }}
          </h3>
        </div>
        <ul class="ml-8 mr-4 mt-4 list-decimal">
          <li
            v-for="app in getPardusAppsById(pkg['pardus_apps'])"
            :key="app.id"
            class="text-gray-300 text-sm"
          >
            <div class="flex items-center">
              <span>{{ app.name }}</span>
              <span
                class="ml-1 flex items-center text-green-500"
                v-if="isInBucket(app.id)"
              >
                <IconCheck class="h-6 w-6" />
              </span>
            </div>
          </li>
        </ul>
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

    function addToBucket(pardusAppIds) {
      pardusAppIds.forEach((id) => store.addToBucket(id));
    }

    return {
      search,
      filteredAppPackages,
      isInBucket: store.isInBucket,
      getPardusAppsById,
      addToBucket,
    };
  },
};
</script>

<style scoped></style>
