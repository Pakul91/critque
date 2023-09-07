<template>
  <div class="flex items-center justify-center md:justify-start">
    <StarRating :rating="averageRating" :size="3" />
    <div v-if="movieData.reviews_count" class="text-xs">
      Based on
      <span class="text-sky-500">{{ movieData.reviews_count }}</span>
      {{ movieData.reviews_count === 1 ? "review" : "reviews" }}
    </div>
    <div v-else class="text-xs">No reviews yet</div>
  </div>
</template>

<script setup>
import StarRating from "./StarRating.vue";

import { computed } from "vue";

const props = defineProps({
  movieData: {
    type: Object,
    required: true,
  },
});

const averageRating = computed(() => {
  if (!props.movieData.average_rating || isNaN(props.movieData.average_rating))
    return 0;

  return props.movieData.average_rating;
});
</script>

<style lang="scss" scoped></style>
