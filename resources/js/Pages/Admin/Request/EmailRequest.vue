<script setup>
import AuthenticatedLayout from '@/Admin/Layouts/AuthenticatedLayout.vue';
import RequestForm from './Partials/RequestForm.vue';
defineOptions({ layout: AuthenticatedLayout });
</script>

<template>

  <Head title="Email Request" />
  <div class="px-6">
    <div class="grid justify-items-center">
      <h1 class="text-2xl font-bold text-center">
        Email Document Request
      </h1>
    </div>
    <div class="grid justify-items-center mt-2">
      <RequestForm />
    </div>
  </div>
</template>