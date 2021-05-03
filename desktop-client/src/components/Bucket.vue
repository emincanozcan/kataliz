<template>
  <div class="px-4 border-t-2 border-gray-600 py-6">
    <h2 class="mb-8 text-xl font-medium">Uygulama Sepeti</h2>
    <div class="relative">
      <div class="flex-1">
        <div class="relative mr-2" v-for="app in apps" :key="app.id">
          <div class="flex items-center py-2 px-2 my-2 bg-gray-700 rounded-md">
            <div>
              <img class="h-8 w-8 mr-4" :src="app.image_url" />
            </div>
            <h4 class="font-bold text-sm text-gray-300">{{ app.name }}</h4>
          </div>
          <button
            class="absolute right-0 top-0 bg-red-500 text-white top-2 -right-2 px-2 py-2 rounded-md"
            @click="removeFromBucket(app.id)"
          >
            X
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import store from "../global-state/store";
import { computed } from "vue";
export default {
  name: "Bucket",
  setup() {
    const apps = computed(() => {
      return store.bucket.value.map((appId) => {
        return store.pardusApps.value.find((item) => item.id === appId);
      });
    });
    const removeFromBucket = store.removeFromBucket;
    return {
      apps,
      bucket: store.bucket,
      removeFromBucket,
    };
  },
};
</script>

<style scoped></style>
