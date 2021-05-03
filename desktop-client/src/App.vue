<template>
  <div class="bg-gray-900 text-gray-100 min-h-screen flex">
    <Sidebar class="h-screen w-64 bg-gray-400 bg-opacity-25" />
    <router-view class="flex-1 bg-gray-900" />
  </div>
</template>
<script>
import Sidebar from "./components/Sidebar";
export default {
  components: { Sidebar },
};
</script>
