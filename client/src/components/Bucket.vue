<template>
  <div class="px-4 border-t-2 border-gray-600 py-6">
    <h2 class="mb-8 text-center text-xl font-medium">
      Uygulama Sepeti <span class="ml-1">({{ apps.length }})</span>
    </h2>
    <div class="flex-1">
      <div class="relative mr-2" v-for="app in apps" :key="app.id">
        <div class="flex items-center py-2 px-2 my-2 bg-gray-700 rounded-md">
          <img class="h-8 w-8 mr-4" :src="app.image_url" />
          <h4 class="font-bold text-sm text-gray-300">{{ app.name }}</h4>
        </div>
        <button
          class="absolute px-1 py-1 transform top-1/2 -translate-y-1/2 bg-red-500 text-white -right-2 rounded-md"
          @click="removeFromBucket(app.id)"
        >
          <IconCross class="w-5 h-5" />
        </button>
      </div>
    </div>
    <button
      class="bg-pardus-yellow px-4 py-2 text-center text-sm text-left tracking-wide text-gray-800 rounded-md shadow-md w-full mt-4"
      v-if="IS_ELECTRON && bucket.length > 0"
      @click="install"
    >
      Kurulumu Gerçekleştir
    </button>
    <button
      class="bg-pardus-yellow px-4 py-2 text-center text-sm text-left tracking-wide text-gray-800 rounded-md shadow-md w-full mt-4"
      v-if="bucket.length > 0"
      @click="exportToFile"
    >
      Kurulum Dosyası Olarak Dışa Aktar
    </button>
  </div>
</template>

<script>
import IconCross from "../icons/icon-cross.svg";
import store from "../global-state/store";
import { computed } from "vue";
import exportToFile from "../actions/exportToFile";
import install from "../actions/install";
export default {
  name: "Bucket",
  components: { IconCross },
  setup() {
    const { IS_ELECTRON } = process.env;
    const apps = computed(() => {
      return store.bucket.value.map((appId) => {
        return store.pardusApps.value.find((item) => item.id === appId);
      });
    });

    const returnObj = {
      IS_ELECTRON,
      apps,
      bucket: store.bucket,
      removeFromBucket: store.removeFromBucket,
    };

    if (IS_ELECTRON) {
      returnObj["install"] = install.install;
      returnObj["exportToFile"] = exportToFile.pardusExport;
    } else {
      returnObj["install"] = () => {};
      returnObj["exportToFile"] = exportToFile.webExport;
    }
    return returnObj;
  },
};
</script>

<style scoped></style>
