<template>
  <header
    class="w-full h-24 sticky flex items-center top-0 left-0 bg-gray-900 border-b-2 border-gray-700 mb-4 py-4 z-50"
  >
    <slot />
  </header>
</template>

<script>
export default {
  name: "Header",
};
</script>

<style scoped></style>
