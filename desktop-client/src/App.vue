<template>
  <div
    v-if="loading"
    class="bg-gray-900 h-screen flex items-center justify-center"
  >
    <Loading loading-message="Uygulama Listesi Yükleniyor" />
  </div>
  <div v-else class="bg-gray-900 text-gray-100 min-h-screen flex">
    <Sidebar
      class="sticky top-0 h-screen w-80 bg-gray-700 bg-opacity-25 flex-shrink-0"
    />
    <router-view class="flex-1 bg-gray-900 mx-6" />
  </div>
</template>
<script>
import Sidebar from "./components/Sidebar";
import store from "./global-state/store";
import Loading from "./components/Loader";
export default {
  components: { Loading, Sidebar },
  setup() {
    store.fetchData().then(() => {
      store.loading.value = false;
    });
    return { loading: store.loading };
  },
};
</script>
