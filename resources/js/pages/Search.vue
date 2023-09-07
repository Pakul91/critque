<template>
  <div class="container mx-auto px-3">
    <form
      class="flex rounded-full bg-slate-800 px-4 py-2 focus-within:ring-2 focus-within:ring-cyan-600 hover:ring-2 hover:ring-cyan-600"
      @submit.prevent="sendSearch"
    >
      <input
        class="w-full appearance-none bg-slate-800 focus:outline-none border-none focus:border-none"
        type="text"
        v-model="searchTerm"
      />
      <button
        class="ml-2 shrink-0 rounded-full bg-gradient-to-br from-sky-500 to-cyan-400 px-3 py-1 text-sm font-medium hover:from-sky-700 hover:to-cyan-600 focus:outline-none focus:ring-2 focus:ring-cyan-600/50"
        type="submit"
      >
        Search
      </button>
    </form>
    <div
      class="text-2xl text-white text-center pt-8 px-8 pb-4"
      v-if="searchResults.length"
    >
      Search term: {{ searchTerm }}
      <div class="text-lg text-white text-center p-3">
        Search results: {{ searchResults.length }}
      </div>
    </div>
    <div class="w-full flex flex-col gap-6 mt-8">
      <Movie
        v-for="result in resultsToDisplay"
        :key="result.id"
        :movie="result"
      />
    </div>

    <div v-if="searchResults.length && searchResults.length > resultsPerPage">
      <Pagination
        :items="searchResults.length"
        :itemsPerPage="resultsPerPage"
        @pageChange="onPageChange"
      />
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from "vue";
import Movie from "../components/Movie.vue";
import Pagination from "../components/Pagination.vue";

const searchTerm = ref("");
const searchResults = ref([]);

const currentPage = ref(1);
const resultsPerPage = 5;

const resultsToDisplay = computed(() => {
  const start = (currentPage.value - 1) * resultsPerPage;
  const end = start + resultsPerPage;
  return searchResults.value.slice(start, end);
});

const sendSearch = async () => {
  const { data } = await axios.post("/api/movies/search", {
    searchParam: searchTerm.value,
  });
  searchResults.value = [...data];
};

const onPageChange = (page) => {
  currentPage.value = page;
};
</script>
