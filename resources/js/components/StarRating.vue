<template>
  <div class="flex max-h">
    <div class="pr-2" v-for="(star, index) in Array(5)" :key="index">
      <ReviewStarHalf
        id="half"
        :class="`h-${size || 6}`"
        v-if="rating > index + 1 && rating < index + 2"
      />
      <ReviewStarFull
        id="full"
        :class="`h-${size || 6}`"
        v-else-if="rating >= index + 1"
      />
      <ReviewStarEmpty id="empty" :class="`h-${size || 6}`" v-else />
    </div>
  </div>
</template>

<script setup>
import ReviewStarEmpty from "./ReviewStarEmpty.vue";
import ReviewStarFull from "./ReviewStarFull.vue";
import ReviewStarHalf from "./ReviewStarHalf.vue";

const props = defineProps({
  rating: {
    type: Number,
    required: true,
  },
  size: {
    type: Number,
  },
});
</script>

<style lang="scss" scoped></style>
