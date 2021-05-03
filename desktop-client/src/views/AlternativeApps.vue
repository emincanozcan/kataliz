<template>
  <div>
    <header
      class="w-full h-20 sticky flex items-center top-0 left-0 bg-gray-900 space-x-16"
    >
      <div class="flex items-center w-96 flex-shrink-0">
        <div class="relative w-full">
          <input
            class="w-full h-12 pl-4 pr-16 font-medium text-sm text-gray-300 bg-gray-800 rounded-lg overflow-hidden transition-all outline-none border-2 border-gray-800 hover:border-pardus-yellow focus:border-pardus-yellow"
            type="text"
            placeholder="Alıştığınız Uygulama"
            @input="search"
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
      <div v-for="nonPardusApp in filteredNonPardusApps" :key="nonPardusApp.id">
        <alternative-app-suggestion-row
          :non-pardus-app="nonPardusApp"
          :pardus-alternatives="
            getAlternativeAppsOfNonPardusAppById(nonPardusApp.id)
          "
        />
      </div>
    </div>
  </div>
</template>

<script>
import IconSearch from "../icons/icon-search.svg";
import store from "../global-state/store";
import AlternativeAppSuggestionRow from "../components/AlternativeAppSuggestionRow";
import { ref } from "vue";

export default {
  name: "AlternativeApps",
  components: {
    AlternativeAppSuggestionRow,
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

    let filteredNonPardusApps = ref([]);
    filteredNonPardusApps.value = nonPardusApps.value;

    function search(event) {
      const searchString = event.target.value;
      filteredNonPardusApps.value = nonPardusApps.value.filter((nonPardusApp) =>
        nonPardusApp.name.toLowerCase().includes(searchString.toLowerCase())
      );
    }

    return {
      nonPardusApps,
      getAlternativeAppsOfNonPardusAppById,
      search,
      filteredNonPardusApps,
    };
  },
};
</script>

<style scoped></style>
