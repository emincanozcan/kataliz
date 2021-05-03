<template>
  <div class="bg-gray-900 text-gray-100 min-h-screen flex">
    <Sidebar
      class="sticky top-0 left-0 h-screen w-64 bg-gray-700 bg-opacity-25 flex-shrink-0"
    />
    <router-view class="flex-1 bg-gray-900" />
  </div>
</template>
<script>
import Sidebar from "./components/Sidebar";
export default {
  components: { Sidebar },
};
</script>
