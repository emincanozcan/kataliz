<template>
  <div v-if="loading">Loading</div>
  <div v-else class="bg-gray-900 text-gray-100 min-h-screen flex">
    <Sidebar
      class="sticky top-0 left-0 h-screen w-96 bg-gray-700 bg-opacity-25 flex-shrink-0"
    />
    <router-view class="flex-1 bg-gray-900 mx-6" />
  </div>
</template>
<script>
import Sidebar from "./components/Sidebar";
import store from "./global-state/store";
export default {
  components: { Sidebar },
  setup() {
    store.fetchData().then(() => {
      store.loading.value = false;
    });
    return { loading: store.loading };
  },
};
</script>
