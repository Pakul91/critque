<template>
  <div
    class="fixed w-full bottom-0 pb-6 pt-2 left-0 bg-slate-900 flex justify-center items-center"
  >
    <button
      @click="goToPage(currentPage - 1)"
      :disabled="currentPage === 1"
      class="w-32 mr-2 py-1 bg-gradient-to-br from-cyan-400 to-sky-500 text-white rounded-l cursor-pointer"
    >
      Previous
    </button>
    <ul class="hidden md:flex space-x-2">
      <li v-for="page in visiblePageRange" :key="page">
        <button
          @click="goToPage(page)"
          :class="[
            'w-8 py-1',
            page === currentPage
              ? 'bg-gradient-to-br from-sky-500 to-cyan-400 text-white'
              : ' bg-slate-800 text-white hover:bg-gradient-to-br from-sky-500 to-cyan-400 hover:text-white',
            'rounded cursor-pointer',
          ]"
        >
          {{ page }}
        </button>
      </li>
    </ul>

    <div
      class="block md:hidden px-4 py-1 bg-gradient-to-br from-sky-500 to-cyan-400 text-white user-select-none rounded cursor-pointer"
    >
      {{ currentPage }}
    </div>

    <button
      @click="goToPage(currentPage + 1)"
      :disabled="currentPage === totalPages"
      class="w-32 ml-2 py-1 bg-gradient-to-br from-sky-500 to-cyan-400 text-white rounded-r cursor-pointer"
    >
      Next
    </button>
  </div>
</template>

<script setup>
import { ref, defineProps, defineEmits, computed } from "vue";

const { items, itemsPerPage } = defineProps(["items", "itemsPerPage"]);

const emit = defineEmits(["pageChange"]);

const currentPage = ref(1);

const totalPages = computed(() => Math.ceil(items / itemsPerPage));

const visiblePageRange = computed(() => {
  const maxVisiblePages = 10;
  const pageRange = [];
  const halfMaxVisiblePages = Math.floor(maxVisiblePages / 2);
  let startPage = Math.max(currentPage.value - halfMaxVisiblePages, 1);
  const endPage = Math.min(startPage + maxVisiblePages - 1, totalPages.value);

  if (endPage === totalPages.value) {
    startPage = Math.max(totalPages.value - maxVisiblePages + 1, 1);
  }

  for (let page = startPage; page <= endPage; page++) {
    pageRange.push(page);
  }

  return pageRange;
});

function goToPage(page) {
  if (page >= 1 && page <= totalPages.value) {
    currentPage.value = page;
    emit("pageChange", currentPage.value);
  }
}
</script>
