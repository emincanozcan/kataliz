<template>
  <div
    class="flex items-center pr-4 bg-gray-800 py-3 rounded-lg mb-4 space-x-16"
  >
    <!-- non pardus app -->
    <div class="w-96 pl-4">
      <div class="flex items-center space-x-4">
        <img class="w-10 h-10" :src="nonPardusApp.image_url" alt="" />
        <span class="font-medium">{{ nonPardusApp.name }}</span>
      </div>
    </div>
    <!-- pardus app alternatives... -->
    <div class="flex space-x-4">
      <div
        class="flex items-center bg-gray-700 px-4 py-2 rounded-lg shadow-lg"
        :key="pardusApp.id"
        v-for="pardusApp in pardusAlternatives"
      >
        <img
          class="w-10 h-10 mr-4 rounded-full"
          :src="pardusApp.image_url"
          :alt="pardusApp.name"
          loading="lazy"
        />
        <span class="font-medium mr-4"> {{ pardusApp.name }}</span>
        <button
          class="bg-pardus-yellow px-4 h-8 rounded-md shadow-md text-gray-900 text-sm"
          @click="addToBucket(pardusApp.id)"
          v-if="!isInBucket(pardusApp.id)"
        >
          Sepete Ekle
        </button>
        <IconCheck v-else class="text-white w-6 h-6 bg-green-600 rounded-md" />
      </div>
    </div>
  </div>
</template>

<script>
import store from "../global-state/store";
import IconCheck from "../icons/icon-check.svg";
export default {
  name: "AlternativeAppSuggestionRow",
  components: {
    IconCheck,
  },
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
    const { addToBucket, isInBucket } = store;
    return {
      addToBucket,
      isInBucket,
    };
  },
};
</script>

<style scoped></style>
