<script setup>
import { ref } from 'vue';
import { useForm } from "@inertiajs/inertia-vue3";
import { useToast } from 'vue-toastification'
import AuthenticatedLayout from '@/Admin/Layouts/AuthenticatedLayout.vue';
import UploadTable from './Partials/UploadTable.vue';
import SelectInput from '../../Components/SelectInput.vue';

const toast = useToast();
defineOptions({ layout: AuthenticatedLayout });
defineProps({
	requirements: [Object, Array],
});
const show = ref(false);
function toggleModal(value) {
	show.value = value;
}
const formData = useForm({
	requirement: null,
	template: null,
});

const handleFileChange = (event) => {
	const file = event.target.files[0];
	formData.template = file;
};

const prepareFormData = () => {
	const data = new FormData();

	Object.keys(formData).forEach(key => {
		if (formData[key] !== undefined) {
			data.append(key, formData[key]);
		}
	});

	return data;
};
const submit = () => {
	const data = prepareFormData();

	formData.post(route("admin.uploads.store"), {
		data: data,
		headers: { 'Content-Type': 'multipart/form-data' },
		onSuccess(response) {
			toast.success("Template Uploaded Successfully");
			toggleModal(false);
		},
		preserveScroll: true,
		preserveState: true
	});
};
</script>

<template>

	<Head title="Upload Files" />
	<div class="px-6">
		<div class="flex items-center justify-between">
			<h1 class="text-2xl font-bold text-center">
				Uploaded Files
			</h1>
			<div class="flex justify-end items-center">
				<button @click="toggleModal(true)"
					class="text-white bg-blue-600 hover:bg-blue-700 font-medium rounded-lg text-sm w-[176px] py-2.5 text-center">
					Upload
				</button>
			</div>
		</div>

		<div class="card !p-2 mt-2">
			<UploadTable :requirements="requirements" />
		</div>

		<!-- Add/Edit modal -->
		<div v-if="show" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-50">
			<div class="bg-white rounded-lg shadow-lg w-full max-w-xl">
				<form @submit.prevent="submit">
					<div class="flex justify-between items-center p-4 border-b">
						<h3 class="text-lg font-semibold">Upload File</h3>
						<button @click="toggleModal(false)" class="text-gray-500 hover:text-gray-700">
							<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
								xmlns="http://www.w3.org/2000/svg">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
									d="M6 18L18 6M6 6l12 12">
								</path>
							</svg>
						</button>
					</div>
					<div class="p-4 mb-2">
						<SelectInput name="Select Requirement" :options="requirements.data"
							v-model:modelValue="formData.requirement" />
						<div class="mt-3">
							<label class="block">Select Template</label>
							<label for="template" class="bg-red-400 text-white px-3 py-1 rounded cursor-pointer">
								Upload File
							</label>
							<input id="template" type="file" class="hidden" @change="handleFileChange"
								accept="application/pdf" />
						</div>


						<div class="mt-5">
							<button class="primary-btn">Submit</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</template>