<template>
  <div class="flex justify-center items-center py-6 space-x-4">
    <div
      class="bg-pardus-yellow text-gray-900 flex items-center h-20 relative overflow-hidden rounded-lg"
    >
      <PardusMascot class="h-24 w-24 w-auto absolute -left-12 opacity-40" />
      <h2
        class="ml-16 mr-6 font-medium font-ubuntu text-5xl tracking-wider text-gray-900"
      >
        Kataliz
      </h2>
    </div>
  </div>
</template>

<script>
import PardusMascot from "../icons/pardus-mascot.svg";

export default {
  name: "Logo",
  components: {
    PardusMascot,
  },
};
</script>

<style scoped></style>
