<script setup>
import AuthenticatedLayout from '@/Admin/Layouts/AuthenticatedLayout.vue';
import HistoryTable from './Partials/HistoryTable.vue';

defineProps({
	records: [Object, Array],
});
defineOptions({layout: AuthenticatedLayout});
</script>

<template>
  <Head title="Approval Queue" />
    <div class="px-6">
      <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-center">
          History
        </h1>
      </div>

      <div class="card !p-2 mt-2">
        <HistoryTable :records="records" />
      </div>
    </div>
</template>