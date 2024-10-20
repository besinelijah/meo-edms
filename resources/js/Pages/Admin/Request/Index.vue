<script setup>
import AuthenticatedLayout from '@/Admin/Layouts/AuthenticatedLayout.vue';
import RequestTable from './Partials/RequestTable.vue';
import { usePage } from '@inertiajs/inertia-vue3';
defineOptions({ layout: AuthenticatedLayout });

const toastSession = usePage().props.toast;
    console.log(toastSession);
</script>
<template>

  <Head title="Requests" />
  <div class="px-6">
    <div class="flex items-center justify-between">
      <h1 class="text-2xl font-bold text-center">
        Document Checklist
      </h1>
    </div>
    <div class="card !p-2 mt-2">
      <RequestTable />
      <div class="w-full grid justify-items-end px-6 mb-2">
        <Link :href="route('admin.requests.email')" class="text-white bg-blue-700 rounded-lg px-5 py-2.5 text-sm">
        Request Document
        </Link>
      </div>
    </div>
  </div>
</template>