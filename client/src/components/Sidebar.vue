<template>
  <aside class="h-full overflow-y-auto flex flex-col justify-between">
    <div class="flex-shrink-0 mb-8">
      <Logo />
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
import Logo from "./Logo";
export default {
  name: "Sidebar",
  components: { Logo, Bucket },
};
</script>

<style scoped></style>
