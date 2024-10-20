<script setup>
import moment from 'moment';
import { ref, onMounted } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';
import Pagination from '@/Components/Pagination.vue';

const props = defineProps({
	records: [Object, Array],
});

const form = useForm({
	page: 1,
});

const routeName = 'admin.history.index';
const items = ref([]);
const lastPage = ref(1);

const fetchData = () => {
	form.get(route('admin.history.index'), {
		preserveState: true,
		onSuccess: (response) => {
			items.value = response.props.records.data;
			lastPage.value = response.props.records.last_page;
		}
	});
};

const changePage = (page) => {
	form.page = page;
};

onMounted(() => {
	form.page = props.records.currentPage ?? 1
});

function formatDate(date) {
	return moment(date).format('MMMM DD, YYYY');
}

function formatDateTime(date) {
	if (date == null) {
		return null
	}
	return moment(date.created_at).format('MMMM DD, YYYY, h:mm:ss a');
}
</script>

<template>
	<div>
		<table class="w-full text-sm text-left">
			<thead class="text-md text-gray-700 uppercase">
				<tr>
					<th class="w-[170px]">Employee ID</th>
					<th>Display Name</th>
					<th>Date Registered</th>
					<th>Last Seen</th>
				</tr>
			</thead>
			<tbody>
				<template v-for="(item, index) in records.data" :key="index">
					<tr class="border-y text-sm text-gray-900">
						<td class="!py-2">{{ String(item.id).padStart(6, '0') }}</td>
						<td class="!py-2">{{ item.lname }}, {{ item.fname }} {{ item.mname }}</td>
						<td class="!py-2">{{ formatDate(item.created_at) }}</td>
						<td class="!py-2">{{ formatDateTime(item.latest_logout) }}</td>
					</tr>
				</template>
			</tbody>
		</table>
		<div
        v-if="records.data.length < 1"
        class="w-full bg-gray-100 text-center text-sm p-5"
      >
        No data available
      </div>
	  <div v-if="records.data.length > 0">
		<Pagination 
			:currentPage="records.current_page"
			:lastPage="records.last_page"
			@page-changed="changePage(records.current_page)"
			:url="routeName"
			:previousPageUrl="records.prev_page_url"
			:nextPageUrl="records.next_page_url"
		/>
	  </div>
		
	</div>
</template>