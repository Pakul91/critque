<template>
  <div class="flex flex-col justify-center gap-x-8 rounded-md bg-slate-800 p-3">
    <div
      class="w-full flex flex-col-reverse items-center gap-y-2 md:flex-row md:justify-between"
    >
      <router-link
        class="hover:text-cyan-400"
        :to="{ name: 'Movie', params: { id: review.movie_id } }"
      >
        <div class="text-xl font-semibold">
          {{ review.movie.title }}
        </div>
      </router-link>
      <div class="ml-auto flex items-center gap-2 text-xl font-semibold">
        {{ review.rating }} <ReviewStarFull class="h-5 text-sky-500" />
      </div>
    </div>
    <MovieAverageRating :movieData="review.movie" />
    <div class="flex justify-center md:justify-start mt-3">
      <p class="mt-3 text-gray-400">
        {{ review?.review }}
      </p>
    </div>
  </div>
</template>

<script setup>
import ReviewStarFull from "./ReviewStarFull.vue";
import MovieAverageRating from "./MovieAverageRating.vue";

const props = defineProps({
  review: {
    type: Object,
    required: true,
  },
});
</script>

<style lang="scss" scoped></style>
