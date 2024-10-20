<script setup>
import AuthenticatedLayout from '@/Admin/Layouts/AuthenticatedLayout.vue';
import ApprovalTable from './Partials/ApprovalTable.vue';
const props = defineProps({
  queue: [Object, Array],
});
defineOptions({ layout: AuthenticatedLayout });
</script>

<template>

  <Head title="Approval Queue" />
  <div class="px-6">
    <div class="flex items-center justify-between">
      <h1 class="text-2xl font-bold text-center">
        Approval Queue
      </h1>
    </div>

    <div class="card !p-2 mt-2">
      <ApprovalTable :queue="queue" />
    </div>
  </div>
</template>