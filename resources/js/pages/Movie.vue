<template>
  <div class="container mx-auto">
    <div class="mx-auto max-w-screen-lg px-3 py-6">
      <div class="flex flex-col gap-6">
        <div
          class="flex flex-col items-center gap-x-8 rounded-md bg-slate-800 p-3 md:flex-row md:flex-wrap"
        >
          <div
            class="w-full flex flex-col flex-wrap items-center gap-y-2 md:flex-row md:justify-between"
          >
            <p class="text-xl font-semibold">
              {{ movie.title }}
            </p>
            <MovieAverageRating class="md:ml-4" :movieData="movie" />

            <button
              type="button"
              class="ml-auto mr-2 shrink-0 rounded-full bg-gradient-to-br from-sky-500 to-cyan-400 px-3 py-1 text-sm font-medium hover:from-sky-700 hover:to-cyan-600 focus:outline-none focus:ring-2 focus:ring-cyan-600/50"
              @click="openReviewForm"
            >
              Add Review
            </button>
            <p class="mt-3 text-gray-400 w-full">{{ movie.tagline }}</p>
          </div>
          <div class="w-full mt-4 mb-4">
            {{ movie.overview }}
          </div>

          <div
            class="hover:text-cyan-400 text-xl font-semibold border-b border-cyan-400 pb-2 mb-4 select-none"
          >
            Reviews
          </div>
          <div
            class="p-3 w-full mt-4 bg-slate-700"
            v-for="review in movie.reviews"
          >
            <div class="text-gray-200">
              <StarRating :rating="review.rating" :size="3" />
              <p class="mt-3">{{ review.review }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <ReviewForm
      v-if="showForm"
      :id="movie.id"
      :title="movie.title"
      @closeForm="closeReviewForm"
      @reviewAdded="onReviewAdded"
    />
  </div>
</template>

<script setup>
import ReviewForm from "../components/ReviewForm.vue";
import MovieAverageRating from "../components/MovieAverageRating.vue";
import StarRating from "../components/StarRating.vue";

import { ref, onMounted } from "vue";
import { useRoute } from "vue-router";

const route = useRoute();
const movie = ref({});
const showForm = ref(false);

onMounted(() => {
  const id = route.params.id;
  getMovie(route.params.id);
});

const getMovie = async (movieId) => {
  const { data } = await axios.get(`/api/movies/${movieId}`);
  movie.value = data.movie;
};

const openReviewForm = () => {
  showForm.value = true;
};

const closeReviewForm = () => {
  showForm.value = false;
};

const onReviewAdded = () => {
  getMovie(route.params.id);
};
</script>
