<template>
  <div class="movie w-full flex rounded-md bg-slate-800 p-3 mb-4">
    <div class="w-full flex flex-col justify-center md:justify-start">
      <router-link
        class="hover:text-cyan-400 flex justify-center md:justify-start"
        :to="{ name: 'Movie', params: { id: movie.id } }"
      >
        <p class="text-xl font-semibold">{{ movie.title }}</p>
      </router-link>
      <MovieAverageRating :movieData="movie" />
      <p
        v-if="movie.tagline"
        class="mt-3 text-gray-400 text-center md:text-left"
      >
        {{ movie.tagline }}
      </p>
    </div>
  </div>
</template>

<script setup>
import MovieAverageRating from "./MovieAverageRating.vue";
const props = defineProps({
  movie: {
    type: Object,
    required: true,
  },
});
</script>

<style></style>
