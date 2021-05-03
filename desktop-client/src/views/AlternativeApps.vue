<template>
  <div class="px-6">
    <header
      class="w-full h-20 sticky flex items-center top-0 left-0 bg-gray-900 space-x-16"
    >
      <div class="flex items-center w-96 flex-shrink-0">
        <div class="relative w-full">
          <input
            class="w-full h-12 pl-4 pr-16 font-medium text-sm text-gray-300 bg-gray-800 rounded-lg overflow-hidden transition-all outline-none border-2 border-gray-800 hover:border-pardus-yellow focus:border-pardus-yellow"
            type="text"
            placeholder="Alıştığınız Uygulama"
          />
          <IconSearch class="w-6 h-6 text-gray-300 absolute right-3 top-3" />
        </div>
      </div>
      <div>
        <h4 class="text-gray-300 font-medium lg:text-lg">
          Alıştığınız Uygulamanın
          <span class="text-pardus-yellow font-bold">PARDUS</span>
          Alternatifleri!
        </h4>
      </div>
    </header>

    <div class="mt-8 min-w-full overflow-x-auto" style="width: max-content">
      <div v-for="nonPardusApp in nonPardusApps" :key="nonPardusApp.id">
        <div
          class="flex items-center bg-gray-800 px-4 py-3 rounded-lg mb-4 space-x-16"
        >
          <!-- non pardus app -->
          <div class="w-96">
            <div class="flex items-center space-x-4">
              <img class="w-10 h-10" :src="nonPardusApp.image_url" alt="" />
              <span class="font-medium text-md">{{ nonPardusApp.name }}</span>
            </div>
          </div>
          <!-- pardus app alternatives... -->
          <div class="flex space-x-12">
            <div
              class="flex items-center"
              :key="pardusApp.id"
              v-for="pardusApp in getAlternativeAppsOfNonPardusAppById(
                nonPardusApp.id
              )"
            >
              <img class="w-10 h-10 mr-2" :src="pardusApp.image_url" alt="" />
              <span class="font-medium mr-4"> {{ pardusApp.name }}</span>
              <button
                class="bg-pardus-yellow px-2 py-1 font-medium rounded-lg shadow-lg text-gray-900"
              >
                Sepete Ekle
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import IconSearch from "../icons/icon-search.svg";
import store from "../global-state/store";

export default {
  name: "AlternativeApps",
  components: {
    IconSearch,
  },
  setup() {
    const { pardusApps, nonPardusApps } = store;

    function getAlternativeAppsOfNonPardusAppById(id) {
      const nonPardusApp = nonPardusApps.value.find((item) => item.id === id);
      const pardusAppIds = nonPardusApp["pardus_apps"];

      let ret = [];
      pardusAppIds.forEach((pardusAppId) => {
        const pardusApp = pardusApps.value.find(
          (item) => item.id === pardusAppId
        );
        ret.push(pardusApp);
      });
      return ret;
    }

    return { nonPardusApps, getAlternativeAppsOfNonPardusAppById };
  },
};
</script>

<style scoped></style>
