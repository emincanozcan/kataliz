<template>
  <div>
    <h1 class="text-2xl text-pardus-yellow font-semibold text-center py-6">
      Pardus Kataliz
    </h1>
    <div class="flex flex-col space-y-2 mt-2 px-4">
      <router-link
        class="px-4 block py-3 text-gray-200 font-medium w-full rounded-lg"
        active-class="bg-gray-800 text-pardus-yellow shadow-lg"
        to="/"
      >
        <span class="font-medium">Alternatif Uygulamalar</span>
      </router-link>
      <router-link
        to="/app-packages"
        class="px-4 block py-3 text-gray-200 font-medium w-full rounded-lg"
        active-class="bg-gray-800 text-pardus-yellow shadow-lg"
      >
        <span class="font-medium">Uygulama Paketleri</span>
      </router-link>
    </div>
  </div>
</template>

<script>
export default {
  name: "Sidebar",
};
</script>

<style scoped></style>
