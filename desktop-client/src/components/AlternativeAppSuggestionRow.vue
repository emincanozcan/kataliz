<template>
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
    <div class="flex space-x-4">
      <div
        class="flex items-center bg-gray-700 px-4 py-2 rounded-lg shadow-lg"
        :key="pardusApp.id"
        v-for="pardusApp in pardusAlternatives"
      >
        <img class="w-10 h-10 mr-2" :src="pardusApp.image_url" alt="" />
        <span class="font-medium mr-4"> {{ pardusApp.name }}</span>
        <button
          class="bg-pardus-yellow px-2 py-1 font-medium rounded-lg shadow-lg text-gray-900"
          @click="addToBucket(pardusApp.id)"
        >
          Sepete Ekle
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import store from "../global-state/store";
export default {
  name: "AlternativeAppSuggestionRow",
  props: {
    nonPardusApp: {
      type: Object,
      required: true,
    },
    pardusAlternatives: {
      required: true,
      type: Array,
    },
  },
  setup() {
    const { addToBucket } = store;
    return {
      addToBucket,
    };
  },
};
</script>

<style scoped></style>
