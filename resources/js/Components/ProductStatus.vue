<script setup>
import { computed } from "vue";

const props = defineProps({
  status: String,
});

const color = computed(() => {
  return (
    {
      "pending": "bg-yellow-600",
      "published": "bg-green-500",
      "rejected": "bg-red-500",
    }[props.status] || ""
  );
});
</script>

<template>
  <span
    :class="color"
    class="
      inline-flex
      text-white
      items-center
      rounded-full
      px-2.5
      py-0.5
      text-xs
      font-medium
    "
  >
    <slot />
  </span>
</template>
