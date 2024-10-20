<template>
    <div class="pagination">
      <button
        :disabled="!previousPageUrl"
        @click="$emit('page-changed', currentPage - 1)"
        class="p-2"
      >
        Previous
      </button>
  
      <span>{{ currentPage }} of {{ lastPage }}</span>
  
      <button
        :disabled="!nextPageUrl"
        @click="$emit('page-changed', currentPage + 1)"
        class="p-2"
      >
        Next
      </button>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      currentPage: {
        type: Number,
        required: true
      },
      lastPage: {
        type: Number,
        required: true
      },
      nextPageUrl: {
        type: String,
        default: null
      },
      previousPageUrl: {
        type: String,
        default: null
      }
    }
  };
  </script>
  