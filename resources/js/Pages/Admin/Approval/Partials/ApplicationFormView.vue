<script setup>
import { useForm } from "@inertiajs/inertia-vue3";
import { ref, computed } from 'vue';
import PdfContainer from '../../../Components/PdfContainer.vue';
import Map from "../../../Components/Map.vue";
import FileAction from "../../../Components/FileAction.vue";
import Pagination from "../../../../Components/Pagination.vue";
import TextInput from "../../../Components/TextInput.vue";
import axios from "axios";

defineProps({
	form: [Object, Array],
	record: [Object, Array],
	client: [Object, Array],
	typeProp: String,
	params: [Object, Array],
	fileApprove:[Object, Array]
});

const pdfDownloadUrl = ref('https://example.com/path/to/your/pdf-file.pdf');
const pdfUrl = ref('https://example.com/path/to/your/pdf-file.pdf');
const title = ref('');
const docRemarks = ref('');
const showPDFtemplate = ref(false);
const showModal = ref(false);
const showMaps = ref(false);
const page = ref(1);
const isPrevDisabled = computed(() => page.value === 1);
const isNextDisabled = computed(() => page.value === 10);
function changePage(isAdd) {
	page.value = isAdd ? page.value + 1 : page.value - 1;
}

const handlePdfUrl = ({ hasFile }) => {
	pdfUrl.value = hasFile;
	showModal.value = true;
}

const handlePdfTitle = ({ label }) => {
	title.value = label;
}

const handlePdfRemarks = ({ documentRemarks }) => {
	docRemarks.value = documentRemarks;
}
const togglePDFformatModal = (event) => {
	showPDFtemplate.value = event;
}

const toggleModal = (event) => {
	showModal.value = event;
}

function toggleMaps(value) {
	showMaps.value = value;
}
const formData = useForm({
	id: null,
	status: null,
	type: null,
	remarks: null,
	data1:null
});

function changeStatus(id, status, type, isSubmit = true, remarks = null,msg) {
	formData.id = id;
	formData.status = status;
	formData.type = type;
	formData.remarks = remarks;
	formData.data1 = msg
	if (isSubmit) {
		submitForm();
	}
}
function submitForm() {
	// axios.post('admin/approval/changestatus',formData)
	formData.post(route('admin.approval.changestatus'));
}
function getType(type) {
	var text = '';
	switch (type) {
		case "1":
			text = "Business Permit (New)";
			break;
		case "2":
			text = "Building Permit";
			break;
		default:
			text = "Business Permit (Renewal)";
			break;
	}
	return text;
}

var currentCategory = '';
var currentSubCategory = '';
const routeName = 'admin.approval.getrecord.index';

function isCurrentCategory(category, index) {
	if (currentCategory != category || index == 0) {
		currentCategory = category;

		return true;
	}

	return false;
}

function isCurrentSubCategory(subcategory, index) {
	if (currentSubCategory != subcategory || index == 0) {
		currentSubCategory = subcategory;

		return true;
	}

	return false;
}

function getUrlWithParams(url) {
	return url;
}
const showRejectModal = ref(false);
const action = ref('');

function toggleRejectModal() {
	showRejectModal.value = !showRejectModal.value;
}
function changeAction(title) {
	action.value = title;
}
</script>
<template>

	<Head title="Application Form View" />
	<div class="px-6 card">
		<div class="flex items-center justify-between">
			<h1 class="text-2xl  text-center">
				Personal Information
			</h1>
		</div>
		<hr class="border-t-2 border-gray-400 mt-2 mb-4" />
		<div>
			Type of Permit: <span class="font-bold uppercase">{{ getType(typeProp) }}</span>
		</div>
		<div>
			Name: <span class="font-bold uppercase">{{ client.lname }}, {{ client.fname }} {{
				client.mname }}</span>
		</div>
	
		<!-- <div>
			Age: <span class="font-bold uppercase">{{ client.age }}</span>
		</div> -->
		<div>
			Sex: <span class="font-bold uppercase">{{ client.sex }}</span>
		</div>
		<div>
			Address/Location: <span class="font-bold uppercase">{{ client.street }}, {{
				client.municipality }}, {{ client.province }}</span>
		</div>
		<div>
			Category: <span class="font-bold uppercase">{{ form.category }}</span>
		</div>
		<div>
			Proposed Location: <span class="text-link italic cursor-pointer" @click="toggleMaps(true)">See Maps</span>
		</div>
		<div class="flex items-center justify-between">
			<h1 class="text-2xl text-center mt-5">
				List of Requirements
			</h1>
		</div>
		<hr class="border-t-2 border-gray-400 mt-2 mb-4" />

		<div class="!p-2 mt-2">
			<PdfContainer :pdfUrl="pdfUrl" :title="title" :show.sync="showModal" @update:show="toggleModal" :remarks="docRemarks"/>
			<Map @update:show="toggleMaps(false)" :show="showMaps" :isView="true" :lat="form.latitude"
				:lng="form.longitude" />
			<div v-for="(item, index) in record.data" :key="index">
				<h1 class="text-2xl font-bold mb-2" v-if="isCurrentCategory(item.category_name, index)">
					{{ item.category_name }}
					<hr class="border-gray-300 mb-6 mt-2" />
				</h1>
				<p class="p-4 bg-violet-200 mb-3" v-if="isCurrentSubCategory(item.subcategory_name, index)">
					{{ item.subcategory_name }}
				</p>
				
				<FileAction :fileData="fileApprove" :label="item.requirements_name" :showDownloadButton="false" :showUploadButton="false"
					:hasFile="item.file_path" :documentId="item.document_id" :documentRemarks="item.document_remarks"
					@pdf-url="handlePdfUrl" @label="handlePdfTitle" @documentRemarks="handlePdfRemarks"/>
			</div>
			<div class="flex items-center justify-between mt-3">
				<Pagination :currentPage="record.current_page" :lastPage="record.last_page" :url="routeName"
					:previousPageUrl="record.prev_page_url" :nextPageUrl="record.next_page_url" :params="params"
					method="post" />
				<div class="flex-shrink-0 flex space-x-3"
					:class="{ 'hidden': record.last_page != record.current_page }">
					<div class="success-btn" @click="changeStatus(form.id, 'Approved', form.type,getType(typeProp))">Approve</div>
					<div class="warning-btn" @click="changeStatus(form.id, 'Returned', form.type, false,getType(typeProp)), toggleRejectModal(), changeAction('Return')">Return</div>
					<div class="danger-btn" @click="changeStatus(form.id, 'Rejected', form.type, false,getType(typeProp)), toggleRejectModal(), changeAction('Reject')">Reject</div>
				</div>
			</div>
			<!-- Reject modal -->
			<div v-if="showRejectModal"
				class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-50">
				<div class="bg-white rounded-lg shadow-lg w-full max-w-xl">
					<form @submit.prevent="submitForm(), toggleRejectModal()">
						<div class="flex justify-between items-center p-4 border-b">
							<h3 class="text-lg font-semibold">{{action}} Application Form</h3>
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

							<textarea name="Remarks" class="w-full h-15 border border-gray-300 rounded p-2" v-model="formData.remarks"></textarea >
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
<style scoped>
.danger-btn {
	@apply cursor-pointer text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium text-sm px-5 py-2.5 text-center me-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900
}

.success-btn {
	@apply cursor-pointer text-white bg-green-600 hover:bg-green-400 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-md text-sm px-5 py-2.5 text-center me-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800
}

.warning-btn {
	@apply cursor-pointer text-white bg-yellow-600 hover:bg-yellow-400 focus:outline-none focus:ring-4 focus:ring-yellow-300 font-medium rounded-md text-sm px-5 py-2.5 text-center me-2 dark:bg-yellow-500 dark:hover:bg-yellow-600 dark:focus:ring-yellow-700
}
</style>