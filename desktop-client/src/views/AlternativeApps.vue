<template>
  <div>
    <header class="w-full flex px-8 py-4 bg-gray-100 bg-opacity-5 items-center">
      <div class="w-128">
        <input
          class="w-full h-12 pl-4 pr-16 font-medium text-sm text-gray-200 bg-gray-800 rounded-lg overflow-hidden transition-all outline-none border-2 border-gray-800 hover:border-pardus-yellow focus:border-pardus-yellow"
          type="text"
          placeholder="Alıştığınız Uygulamayı Yazınız"
          @input="search"
        />
      </div>
      <h2 class="font-medium text-xl ml-24 whitespace-nowrap">
        Aradığınız Uygulamaların Pardus Alternatifleri!
      </h2>
    </header>
  </div>
</template>

<script>
export default {
  name: "AlternativeApps",
};
</script>

<style scoped></style>
