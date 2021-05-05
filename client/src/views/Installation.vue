<template>
  <div
    class="w-full min-h-screen h-full px-8 py-8 text-gray-100 flex justify-center items-center flex-col bg-gray-800"
  >
    <IconPardusLogo class="w-48 h-48 animate-pulse mb-4" />
    <h2 class="text-2xl font-bold text-pardus-yellow mb-16">
      Kurulumlar Gerçekleştiriliyor.
    </h2>
    <div class="space-y-4 mb-16">
      <div
        class="rounded-lg bg-gray-900 shadow-lg px-6 flex items-center py-4 font-medium space-x-8"
        v-for="(item, key) in installationState"
        :key="key"
      >
        <div class="text-white inline-block w-64 border-r border-gray-300">
          {{ item.name }}
        </div>
        <div class="inline-block font-medium">
          <span class="text-green-600" v-if="item.status === 'end'">
            Kurulum Tamamlandı
          </span>
          <span class="text-red-600" v-else-if="item.status === 'error'">
            Kurulumda Bir Hata Oluştu
          </span>
          <span class="text-white" v-else-if="item.status === 'in-progress'">
            Yükleniyor..
          </span>
          <span
            class="text-pardus-yellow"
            v-else-if="item.status === 'waiting'"
          >
            Diğer kurulumlar bekleniyor
          </span>
        </div>
      </div>
    </div>
    <div v-if="isEnd" class="text-center">
      <div class="font-medium text-2xl">Kurulumlar tamamlandı!</div>
      <button
        class="mx-auto mt-4 inline-block px-8 py-3 bg-pardus-yellow text-black rounded-lg shadow-lg"
        @click="$emit('close')"
      >
        Uygulamaya Dön
      </button>
    </div>
    <div class="font-medium text-lg" v-else>
      Lütfen kurulumların tamamlanmasını bekleyiniz.
    </div>
  </div>
</template>

<script>
import store from "../global-state/store";
import { ref } from "vue";
import IconPardusLogo from "../icons/icon-pardus-logo.svg";

export default {
  name: "Installation",
  components: { IconPardusLogo },
  setup() {
    const isEnd = ref(false);
    const installationState = ref([]);
    installationState.value.push({
      key: "pre-installation",
      name: "Ön Kurulumlar",
      status: "waiting",
    });

    store.bucket.value.forEach((appId) => {
      const app = store.pardusApps.value.find((app) => app.id === appId);
      installationState.value.push({
        key: app.id,
        name: app.name,
        status: "waiting",
      });
    });

    window.ipcRenderer.on("installation-update", (event, data) => {
      const index = installationState.value.findIndex(
        (i) => i.key.toString() === data.id
      );
      installationState.value[index].status = data.status;
    });

    window.ipcRenderer.on("installation-end", () => {
      installationState.value.forEach(
        (item) => item.status === "end" && store.removeFromBucket(item.key)
      );
      isEnd.value = true;
    });

    return { installationState, isEnd };
  },
};
</script>

<style scoped></style>
