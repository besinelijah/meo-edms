<script setup>
import AuthenticatedLayout from '../../../../Admin/Layouts/AuthenticatedLayout.vue';
defineOptions({ layout: AuthenticatedLayout });

const props = defineProps({
  totals: { type: Object, required: true },
  totalsToday: { type: Object, required: true },
  totalsApproved:{type:Object,required:false}
});
</script>

<template>
  <div class="card">
    <h2 class="font-bold text-lg text-typography leading-tight mb-2">Dashboard</h2>
    <div class="flex">
      <div class="flex-1 overflow-hidden rounded-lg shadow-lg m-2 p-6 bg-sky-500">
        <p class="text-center text-white mt-2 " style="font-weight: bold; font-size: 1.3em;">Business Permit</p>
        <p class="text-center text-white mt-2">Total Approved: {{ totalsApproved.businessPermit }}</p>
        <p class="text-center text-white mt-2">Total Application: {{ totals.businessPermit }}</p>
        <p class="text-center text-white mt-2">Today: {{ totalsToday.businessPermit }}</p>
      </div>
      <div class="flex-1 overflow-hidden rounded-lg shadow-lg m-2 p-6 bg-blue-800">
        <p class="text-center text-white mt-2" style="font-weight: bold; font-size: 1.3em;">Building Permit</p>
        <p class="text-center text-white mt-2">Total Approved: {{totalsApproved.businessPermit }}</p>
        <p class="text-center text-white mt-2">Total Application: {{ totals.building }}</p>
        <p class="text-center text-white mt-2">Today: {{ totalsToday.building }}</p>
      </div>
      <div class="flex-1 overflow-hidden rounded-lg shadow-lg m-2 p-6 bg-red-800">
        <p class="text-center text-white mt-2" style="font-weight: bold; font-size: 1.3em;">Business Permit Renewal</p>
        <p class="text-center text-white mt-2">Total Approved: {{totalsApproved.renewal }}</p>
        <p class="text-center text-white mt-2">Total Application: {{ totals.renewal }}</p>
        <p class="text-center text-white mt-2">Today: {{ totalsToday.renewal }}</p>
      </div>
    </div>
  </div>
</template>
