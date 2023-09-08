<template>
  <div class="flex max-h">
    <div class="pr-2" v-for="(star, index) in Array(5)" :key="index">
      <ReviewStarHalf
        id="half"
        class="h-3"
        :class="starSize"
        v-if="rating > index + 1 && rating < index + 2"
      />
      <ReviewStarFull
        id="full"
        :class="starSize"
        v-else-if="rating >= index + 1"
      />
      <ReviewStarEmpty id="empty" :class="starSize" v-else />
    </div>
  </div>
</template>

<script setup>
import ReviewStarEmpty from "./ReviewStarEmpty.vue";
import ReviewStarFull from "./ReviewStarFull.vue";
import ReviewStarHalf from "./ReviewStarHalf.vue";
import { computed } from "vue";

const props = defineProps({
  rating: {
    type: Number,
    default: 0,
  },
  size: {
    type: Number,
  },
});

const starSize = computed(() => {
  return `h-${props.size}`;
});
</script>

<style lang="scss" scoped></style>
