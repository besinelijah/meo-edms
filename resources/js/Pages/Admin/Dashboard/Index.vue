<script setup>
import AuthenticatedLayout from '@/Admin/Layouts/AuthenticatedLayout.vue';
import ApprovalTable from './Partials/ApprovalTable.vue';
import HistoryTable from './Partials/HistoryTable.vue';
import Widgets from './Partials/Widgets.vue';
import Widgets2 from './Partials/Widgets2.vue';
const props = defineProps({
	data: [Object, Array],
});
defineOptions({layout: AuthenticatedLayout});

</script>

<template>
  <Head title="Dashboard" />
    <div class="flex h-full">
      <div class="flex-auto w-9/12">
        <Widgets :totalsApproved="data.totalsApproved" :totals="data.totals" :totalsToday="data.totalsToday"/>
        <Widgets2 />
      </div>
      <div class="flex-auto w-3/12 pl-5 h-full">
        <div class="card !p-4 h-full">
          <HistoryTable :data="data"/>
        </div>
      </div>
    </div>
</template>
