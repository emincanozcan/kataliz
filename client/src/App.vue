<template>
  <InstallationInstructionsModal
    v-if="installationInstructionsModalOpen"
    :filename="installationInstructionsModalFileName"
    @close="closeInstallationInstructionsModal"
  />
  <div
    v-if="IS_ELECTRON && installationOpen"
    class="bg-gray-900 h-screen flex items-center justify-center"
  >
    <Installation @close="onInstallationEnd" />
  </div>
  <div
    v-else-if="loading"
    class="bg-gray-900 h-screen flex items-center justify-center"
  >
    <Loading loading-message="Uygulama Listesi Yükleniyor" />
  </div>
  <div v-else class="bg-gray-900 text-gray-100 min-h-screen flex">
    <Sidebar
      class="sticky top-0 h-screen w-80 bg-gray-700 bg-opacity-25 flex-shrink-0"
    />
    <transition name="fade">
      <router-view class="flex-1 bg-gray-900 mx-6" />
    </transition>
  </div>
</template>
<script>
import Sidebar from "./components/Sidebar";
import store from "./global-state/store";
import Loading from "./components/Loader";
import { ref } from "vue";
import Installation from "./views/Installation";
import InstallationInstructionsModal from "./components/InstallationInstructionsModal";
export default {
  components: { InstallationInstructionsModal, Installation, Loading, Sidebar },
  setup() {
    const { IS_ELECTRON } = process.env;
    store.fetchData().then(() => {
      store.loading.value = false;
    });
    if (IS_ELECTRON) {
      window.ipcRenderer.on(
        "installation-start",
        () => (installationOpen.value = true)
      );
    }
    const installationOpen = ref(false);
    function onInstallationEnd() {
      installationOpen.value = false;
    }

    const installationInstructionsModalOpen = ref(false);
    const closeInstallationInstructionsModal = () =>
      (installationInstructionsModalOpen.value = false);
    const installationInstructionsModalFileName = ref("");

    if (IS_ELECTRON) {
      window.ipcRenderer.on("open-installation-instructions", (e, fileName) => {
        installationInstructionsModalOpen.value = true;
        installationInstructionsModalFileName.value = fileName;
      });
    } else {
      window.addEventListener("open-installation-instructions", (e) => {
        installationInstructionsModalOpen.value = true;
        installationInstructionsModalFileName.value = e.detail.fileName;
      });
    }

    return {
      loading: store.loading,
      installationOpen,
      onInstallationEnd,
      closeInstallationInstructionsModal,
      installationInstructionsModalOpen,
      IS_ELECTRON,
      installationInstructionsModalFileName,
    };
  },
};
</script>
<style>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s ease;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
</style>
