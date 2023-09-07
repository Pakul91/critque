<template>
  <div class="flex items-center justify-center md:justify-start">
    <StarRating :rating="movieData.average_rating" :size="3" />
    <div class="text-xs">
      Based on
      <span class="text-sky-500">{{ movieData.reviews_count }}</span>
      {{ movieData.reviews_count === 1 ? "review" : "reviews" }}
    </div>
  </div>
</template>

<script setup>
import StarRating from "./StarRating.vue";

const props = defineProps({
  movieData: {
    type: Object,
    required: true,
  },
});
</script>

<style lang="scss" scoped></style>
