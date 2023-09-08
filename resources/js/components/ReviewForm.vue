<template>
  <div
    id="overlay"
    class="absolute bg-black/80 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-full h-full flex justify-center items-center"
  >
    <div
      id="modal"
      class="container max-w-xl flex flex-col text-center md:text-left bg-slate-800 w-10/12 p-3 md:p-6 rounded-md"
    >
      <div class="flex w-full justify-end mb-1">
        <div class="w-6 cursor-pointer" @click="closeForm">
          <CloseIcon />
        </div>
      </div>

      <p v-if="formError" class="mb-4 text-lg text-red-400 sm:text-xl">
        {{ formError }}
      </p>

      <p class="mb-4 text-lg sm:text-xl">
        Tell us how you liked the
        <span class="block sm:inline-block text-cyan-400">{{ title }}</span>
      </p>

      <div class="mb-4">
        <p :class="{ 'mb-4': !starsError }">Sprinkle some stars!</p>
        <p v-if="starsError" class="m-0 p-0 text-sm text-red-400">
          At least one... please...
        </p>
        <div class="flex ml-2 justify-center md:justify-start">
          <div
            class="pr-2"
            v-for="(star, index) in Array(5)"
            :key="index"
            @click="onStarClicked(index + 1)"
            @mouseenter="onStarHovered(index + 1)"
            @mouseleave="onStarHovered(0)"
          >
            <ReviewStarFull
              id="full"
              class="h-6"
              v-if="activeStar >= index + 1 || hoveredStar >= index + 1"
            />
            <ReviewStarEmpty id="empty" class="h-6" v-else />
          </div>
        </div>
      </div>
      <div class="mb-4">
        <p :class="{ 'mb-4': !reviewError }">Write a review!</p>
        <p v-if="reviewError" class="m-0 p-0 text-sm text-red-400">
          {{ reviewError }}
        </p>
        <textarea
          placeholder="Share your deepest thoughts..."
          v-model="review"
          @input="reviewError = false"
          class="w-full h-32 sm:h-48 border border-gray-300 text-slate-800 rounded-md resize-none p-2 focus:outline-none placeholder:text-sm"
        ></textarea>
      </div>

      <div>
        <button
          type="button"
          class="ml-auto mr-2 shrink-0 rounded-full bg-gradient-to-br from-sky-500 to-cyan-400 px-3 py-1 text-sm font-medium hover:from-sky-700 hover:to-cyan-600 focus:outline-none focus:ring-2 focus:ring-cyan-600/50 float-right"
          @click="submitForm"
        >
          Submit Review
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { defineProps, ref } from "vue";
import ReviewStarFull from "./ReviewStarFull.vue";
import ReviewStarEmpty from "./ReviewStarEmpty.vue";
import CloseIcon from "./CloseIcon.vue";

const props = defineProps({
  id: Number,
  title: String,
});

const emit = defineEmits(["closeForm", "reviewAdded"]);

const activeStar = ref(0);
const hoveredStar = ref(0);
const starsError = ref(false);
const review = ref("");
const reviewError = ref(false);
const formError = ref(false);

const onStarClicked = (index) => {
  starsError.value = false;
  activeStar.value = index;
};

const onStarHovered = (index) => {
  hoveredStar.value = index;
};

const submitForm = async () => {
  if (!validate()) return;

  const data = {
    movie_id: props.id,
    review: review.value,
    rating: activeStar.value,
  };

  try {
    await axios.post("/api/reviews", data);

    emit("reviewAdded");
    emit("closeForm");
  } catch (error) {
    formError.value = error.response?.data?.message;
  }
};

const validate = () => {
  let valid = true;

  if (activeStar.value === 0) {
    starsError.value = true;
    valid = false;
  }

  if (review.value === "") {
    reviewError.value = "Please write a review";
    valid = false;
  } else if (review.value.length < 2) {
    reviewError.value = "Please write a longer review";
    valid = false;
  } else if (review.value.length > 500) {
    reviewError.value = "Please write a shorter review";
    valid = false;
  }

  return valid;
};

const closeForm = () => {
  emit("closeForm");
};
</script>

<style></style>
