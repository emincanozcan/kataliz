<template>
  <div
    class="w-full h-full px-8 py-8 text-gray-100 flex justify-center items-center flex-col bg-gray-800"
  >
    <h2 class="text-2xl font-bold text-pardus-yellow mb-4">
      Kurulumlar Gerçekleştiriliyor.
    </h2>
    <IconPardusLogo class="w-48 h-48 animate-pulse mb-16" />
    <div class="space-y-4 mb-16">
      <div
        class="rounded-lg bg-gray-900 shadow-lg px-6 flex items-center py-4 font-medium space-x-8"
        v-for="(item, key) in installationState"
        :key="key"
      >
        <div class="inline-block w-64 border-r border-gray-300">
          {{ item.name }}
        </div>
        <div class="inline-block">{{ item.status }}</div>
      </div>
    </div>
    <div v-if="isEnd" class="text-center">
      <div class="font-medium text-lg">Kurulumlar tamamlandı!</div>
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
import { reactive, ref } from "vue";
import IconPardusLogo from "../icons/icon-pardus-logo.svg";

export default {
  name: "Installation",
  components: { IconPardusLogo },
  setup() {
    const isEnd = ref(false);
    const installationState = reactive({});
    store.bucket.value.forEach((appId) => {
      const app = store.pardusApps.value.find((app) => app.id === appId);
      installationState[app.id] = {
        name: app.name,
        status: "Diğer kurulumlar bekleniyor.",
      };
    });

    window.ipcRenderer.on("installation-update", (event, data) => {
      console.log({ data });
      if (data.status === "end") {
        installationState[data.id].status = "Kurulum tamamlandı.";
      } else if (data.status === "in-progress") {
        installationState[data.id].status = "Kuruluyor.";
      }
    });

    window.ipcRenderer.on("installation-end", () => (isEnd.value = true));

    return { installationState, isEnd };
  },
};
</script>

<style scoped></style>
