<script setup>
import { ref } from "vue";
import moment from "moment";
import { useForm } from "@inertiajs/inertia-vue3";
import TextInput from "../../../Components/TextInput.vue";

function formatDate(date) {
	return moment(date).format("MMMM DD, YYYY h:mm a");
}

const props = defineProps({
	data: [Object, Array],
});

const openMenuIndex = ref(null);

const toggleMenu = (index) => {
	openMenuIndex.value = openMenuIndex.value === index ? null : index;
};

const formData = useForm({
	id: null,
	status: null,
	type: null,
	remarks: null,
	clientId: null,
});

function changeStatus(id, status, type, isSubmit = true, remarks = null) {
	formData.id = id;
	formData.status = status;
	formData.type = type;
	formData.remarks = remarks;

	if (isSubmit) {
		submitForm();
	}
}

function submitForm() {
	formData.post(route('admin.approval.changestatus'));
}

function getRecord(id, type, clientId) {
	formData.id = id;
	formData.type = type;
	formData.clientId = clientId;

	formData.post("/admin/approval/getRecord");
}


const showRejectModal = ref(false);

function toggleRejectModal() {
	showRejectModal.value = !showRejectModal.value;
}
</script>

<template>
	<div class="relative">
		<div class="flex w-full justify-between">
			<h2 class="font-bold text-lg text-typography leading-tight">Approval Queue</h2>
			<Link :href="route('admin.approval.index')" as="a" class="px-4 py-2 rounded hover:text-blue">See all</Link>
		</div>
		<div class="overflow-x-auto bg-white pt-2">
			<table class="w-full text-sm text-left">
				<thead class="text-md text-gray-700 uppercase">
					<tr>
						<th>Name of Owner</th>
						<th>Project Title</th>
						<th>Date of Application</th>
						<th>Remarks</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<template v-for="(item, index) in data.queue" :key="index">
						<tr class="border-y text-sm text-gray-900">
							<td class="!py-2">
								{{ item.client.lname }}, {{ item.client.fname }}
								{{ item.client.mname }}
							</td>
							<td class="!py-2">{{ item.project_title }}</td>
							<td class="!py-2">{{ formatDate(item.application_date) }}</td>
							<td class="!py-2">{{ item.remarks }}</td>
							<td class="!py-2 whitespace-nowrap">
								<span class="p-2 rounded" :class="{
									'bg-green-100': item.status == 'Approved',
									'bg-red-100': item.status == 'Rejected',
									'bg-yellow-100': item.status == 'Pending',
								}">
									<i class="mr-2" :class="{
										'fas fa-check-circle text-green-500': item.status == 'Approved',
										'fas fa-times-circle text-red-500': item.status == 'Rejected',
										'fas fa-hourglass-half text-yellow-500': item.status == 'Pending',
									}"></i>
									{{ item.status }}
								</span>
							</td>
							<td class="!py-2 text-center">
								<button @click="toggleMenu(index)"
									class="p-2 text-gray-600 hover:text-gray-900 relative">
									<i class="fas fa-ellipsis-v"></i>
								</button>

								<div v-if="openMenuIndex === index"
									class="absolute right-0 mt-2 w-48 bg-white border border-gray-300 rounded-md shadow-lg z-50">
									<ul>
										<li>
											<button
												@click="changeStatus(item.id, 'Approved', item.type), toggleMenu(index)"
												class="w-full block px-4 py-2 text-gray-700 hover:bg-gray-100">
												Approve
											</button>
										</li>
										<li>
											<button
												@click="changeStatus(item.id, 'Rejected', item.type, false), toggleMenu(index), toggleRejectModal()"
												class="w-full block px-4 py-2 text-gray-700 hover:bg-gray-100">
												Reject
											</button>
										</li>
										<li>
											<button @click="getRecord(item.id, item.type, item.client_id)"
												class="w-full block px-4 py-2 text-gray-700 hover:bg-gray-100 relative">
												View
											</button>
										</li>
									</ul>
								</div>
							</td>
						</tr>
					</template>
				</tbody>
			</table>
			<div v-if="data.queue.length < 1" class="w-full bg-gray-100 text-center text-sm p-5">
				No data available
			</div>

			<!-- Reject modal -->
			<div v-if="showRejectModal"
				class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-50">
				<div class="bg-white rounded-lg shadow-lg w-full max-w-xl">
					<form @submit.prevent="submitForm(), toggleRejectModal()">
						<div class="flex justify-between items-center p-4 border-b">
							<h3 class="text-lg font-semibold">Reject Application Form</h3>
							<button @click="toggleRejectModal" class="text-gray-500 hover:text-gray-700">
								<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
									xmlns="http://www.w3.org/2000/svg">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
										d="M6 18L18 6M6 6l12 12">
									</path>
								</svg>
							</button>
						</div>
						<div class="p-4 h-[20vh]">

							<TextInput name="Remarks" v-model:modelValue="formData.remarks"></TextInput>
							<div class="mt-5">
								<button class="primary-btn">Submit</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</template>

<style>
/* Additional styles if needed */
</style>
p