<template>
  <div class="h-full flex items-center justify-center flex-col">
    <IconPardusLogo class="w-64 h-64 animate-pulse" />
    <p class="text-2xl font-medium text-pardus-yellow mt-8 animate-pulse">
      {{ loadingMessage }}
    </p>
  </div>
</template>

<script>
import IconPardusLogo from "../icons/icon-pardus-logo.svg";

export default {
  name: "Loading",
  props: ["loadingMessage"],
  components: {
    IconPardusLogo,
  },
};
</script>
