<template>
  <aside class="h-full overflow-y-auto flex flex-col justify-between">
    <div class="flex-shrink-0 mb-8">
      <div class="flex justify-center items-center py-6 space-x-4">
        <IconPardusLogo class="h-20 w-20" />
        <h1
          class="text-2xl tracking-wider leading-none mt-0 text-pardus-yellow font-semibold text-center"
        >
          Pardus<br />Kataliz
        </h1>
      </div>
      <div class="flex flex-col space-y-2 mt-2 px-4">
        <router-link
          class="px-4 block py-3 text-gray-200 font-bold w-full rounded-lg"
          active-class="bg-gray-700 shadow-lg"
          to="/"
        >
          Alternatif Uygulamalar
        </router-link>
        <router-link
          to="/app-packages"
          class="px-4 block py-3 text-gray-200 font-bold w-full rounded-lg"
          active-class="bg-gray-700 shadow-lg"
        >
          Uygulama Paketleri
        </router-link>
      </div>
    </div>
    <Bucket class="h-auto overflow-y-auto" />
  </aside>
</template>

<script>
import Bucket from "./Bucket";
import IconPardusLogo from "../icons/icon-pardus-logo.svg";
export default {
  name: "Sidebar",
  components: { Bucket, IconPardusLogo },
};
</script>

<style scoped></style>
