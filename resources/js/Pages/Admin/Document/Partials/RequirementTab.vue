<script setup>
import { ref } from 'vue';
import { useForm } from "@inertiajs/inertia-vue3";
import { useToast } from 'vue-toastification';
import TextInput from '../../../Components/TextInput.vue';
import SelectInput from '../../../Components/SelectInput.vue';
import FileAction from '../../../Components/FileAction.vue';

const toast = useToast();

defineProps({
	subcategories: [Object, Array],
	requirements: [Object, Array],
	active: { type: String, required: true }
});

const show = ref(false);

function toggleModal() {
	show.value = !show.value;
}

const options = [
	{ label: 'Business Permit (New)', value: 1 },
	{ label: 'Building Permit', value: 2 },
	{ label: 'Business Permit (Renew)', value: 3 },
];

const formData = useForm({
	requirement: null,
	subcategory: null,
	type: null,
});

// Validation error states
const subcategoryError = ref(null);
const typeError = ref(null);
const requirementError = ref(null);

const submit = () => {
	// Clear previous errors
	subcategoryError.value = null;
	typeError.value = null;
	requirementError.value = null;

	// Validate if fields are filled
	let hasError = false;
	if (!formData.subcategory) {
		subcategoryError.value = 'Subcategory is required';
		hasError = true;
	}
	if (!formData.type) {
		typeError.value = 'Permit type is required';
		hasError = true;
	}
	if (!formData.requirement) {
		requirementError.value = 'Requirement name is required';
		hasError = true;
	}

	// If there are validation errors, don't proceed with form submission
	if (hasError) return;

	// If validation passes, submit the form
	formData.post(route("admin.document.addrequirement"), {
		onSuccess(response) {
			toast.success("Requirement successfully added");
			toggleModal();
		},
	});
};

const deleteForm = useForm({
	id: null,
});

function deleteItem(id) {
	deleteForm.delete('/admin/documents/requirement/' + id);
}

</script>

<template>
	<div class="w-full">
		<button style="position: absolute; margin-top: -52px; right: 55px; width: 16%;" class="text-white bg-blue-700 rounded-lg px-5 py-2.5 text-sm" @click="toggleModal">
			Add Requirement
		</button>
		<table class="w-full text-sm text-left">
			<thead class="text-md text-gray-700 uppercase">
				<tr>
					<th class="w-1/5">Category</th>
					<th class="w-2/5">Subcategory</th>
					<th class="w-2/5">Requirement Name</th>
					<th class="w-2/5">Document Type</th>
					<th class="flex justify-between items-center">
						<span>Action</span>
					</th>
				</tr>
			</thead>
			<tbody>
				<template v-for="(item, index) in requirements" :key="index">
					<tr class="border-y text-sm text-gray-900">
						<td class="!py-2">{{ item.category_name }}</td>
						<td class="!py-2">{{ item.subcategory_name }}</td>
						<td class="!py-2">{{ item.requirements_name }}</td>
						<td class="!py-2">{{ item.permit_type_name }}</td>
						<td class="!py-2 whitespace-nowrap">
							<span class="p-2 rounded cursor-pointer" @click="deleteItem(item.requirements_id)">
								<i class="fas fa-trash text-red-500"></i>
							</span>
						</td>
					</tr>
				</template>
			</tbody>
		</table>
	</div>

	<!-- Add/Edit modal -->
	<div v-if="show" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-50">
		<div class="bg-white rounded-lg shadow-lg w-full max-w-xl">
			<form @submit.prevent="submit">
				<div class="flex justify-between items-center p-4 border-b">
					<h3 class="text-lg font-semibold">Add Requirement</h3>
					<button @click="toggleModal" class="text-gray-500 hover:text-gray-700">
						<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
							xmlns="http://www.w3.org/2000/svg">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
						</svg>
					</button>
				</div>
				<div class="p-4 mb-2">
					<SelectInput name="Select Subcategory" :options="subcategories" v-model:modelValue="formData.subcategory"/>
					<!-- Show validation error for subcategory -->
					<p v-if="subcategoryError" class="text-red-500 text-sm">{{ subcategoryError }}</p>
					
					<SelectInput name="Select Permit Type" :options="options" v-model:modelValue="formData.type"/>
					<!-- Show validation error for permit type -->
					<p v-if="typeError" class="text-red-500 text-sm">{{ typeError }}</p>

					<TextInput name="Requirement Name" v-model:modelValue="formData.requirement"/>
					<!-- Show validation error for requirement -->
					<p v-if="requirementError" class="text-red-500 text-sm">{{ requirementError }}</p>

					<div class="mt-5">
						<button class="primary-btn">Submit</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</template>
