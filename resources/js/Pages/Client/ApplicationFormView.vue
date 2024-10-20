<script setup>
import { useForm, usePage } from "@inertiajs/inertia-vue3";
import { ref, computed } from "vue";
// import PdfContainer from '../../../Components/PdfContainer.vue';
import PdfContainer from "../Components/PdfContainer.vue";
// import Map from "../../../Components/Map.vue";
import Map from "../Components/Map.vue";
// import FileAction from "../../../Components/FileAction.vue";
import FileAction from "../Components/FileAction.vue";
import Pagination from "../../Components/Pagination.vue";
import ClientLayout from "../../Shared/ClientLayout.vue";
fileApprove: [Object, Array];
defineOptions({ layout: ClientLayout });

defineProps({
    form: [Object, Array],
    record: [Object, Array],
    client: [Object, Array],
    typeProp: String,
    params: [Object, Array],
    fileApprove: [Object, Array],
});
const { url } = usePage();
const isActiveRoute = (baseRoute) => {
    return computed(() => url.value.startsWith(baseRoute));
};
const isNotificationPage = isActiveRoute("/notifications");

const pdfDownloadUrl = ref("https://example.com/path/to/your/pdf-file.pdf");
const pdfUrl = ref("https://example.com/path/to/your/pdf-file.pdf");
const title = ref("");
const docRemarks = ref("");
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
    console.log(pdfUrl);
};
const handlePdfTitle = ({ label }) => {
    title.value = label;
};
const handlePdfRemarks = ({ documentRemarks }) => {
    docRemarks.value = documentRemarks;
};
const togglePDFformatModal = (event) => {
    showPDFtemplate.value = event;
};
const toggleModal = (event) => {
    showModal.value = event;
};

function toggleMaps(value) {
    showMaps.value = value;
}
const formData = useForm({
    id: null,
    status: null,
    type: null,
});

function changeStatus(id, status, type) {
    formData.id = id;
    formData.status = status;
    formData.type = type;

    formData.post("/admin/approval/changeStatus");
}

function getType(type) {
    var text = "";
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

var currentCategory = "";
var currentSubCategory = "";
const routeName =
    isNotificationPage == true
        ? "notifications.getrecord.index"
        : "my-application-forms-record";

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
</script>
<template>
    <Head title="Application Form View" />
    <div class="px-6 card">
        <div
            :class="{
                'bg-red-200': form.status == 'Rejected',
                'bg-green-100': form.status == 'Approved',
                'bg-yellow-100': form.status == 'Pending',
                'bg-orange-200': form.status == 'Returned',
            }"
            class="p-2"
        >
            <div>
                Status :
                <span class="font-bold uppercase">{{ form.status }}</span>
            </div>
            Remarks :
            <span class="font-bold uppercase">{{ form.remarks }}</span>
        </div>
        <div class="flex items-center justify-between">
            <h1 class="text-2xl text-center">Personal Information</h1>
        </div>
        <hr class="border-t-2 border-gray-400 mt-2 mb-4" />
        <div>
            Type of Permit:
            <span class="font-bold uppercase">{{ getType(typeProp) }}</span>
        </div>
        <div>
            Name:
            <span class="font-bold uppercase"
                >{{ client.lname }}, {{ client.fname }} {{ client.mname }}</span
            >
        </div>
        <!-- <div>
			Age: <span class="font-bold uppercase">{{ client.age }}</span>
		</div> -->
        <div>
            Sex: <span class="font-bold uppercase">{{ client.sex }}</span>
        </div>
        <div>
            Address/Location:
            <span class="font-bold uppercase"
                >{{ client.street }}, {{ client.municipality }},
                {{ client.province }}</span
            >
        </div>
        <div>
            Category:
            <span class="font-bold uppercase">{{ form.category }}</span>
        </div>
        <div>
            Proposed Location:
            <span
                class="text-link italic cursor-pointer"
                @click="toggleMaps(true)"
                >See Maps</span
            >
        </div>
        <div class="flex items-center justify-between">
            <h1 class="text-2xl text-center mt-5">List of Requirements</h1>
        </div>
        <hr class="border-t-2 border-gray-400 mt-2 mb-4" />

        <div class="!p-2 mt-2">
            <PdfContainer
                :pdfUrl="pdfUrl"
                :title="title"
                :show.sync="showModal"
                @update:show="toggleModal"
                :remarks="docRemarks"
            />
            <Map
                @update:show="toggleMaps(false)"
                :show="showMaps"
                :isView="true"
                :lat="form.latitude"
                :lng="form.longitude"
            />
            <div v-for="(item, index) in record.data" :key="index">
                <h1
                    class="text-2xl font-bold mb-2"
                    v-if="isCurrentCategory(item.category_name, index)"
                >
                    {{ item.category_name }}
                    <hr class="border-gray-300 mb-6 mt-2" />
                </h1>
                <p
                    class="p-4 bg-violet-200 mb-3"
                    v-if="isCurrentSubCategory(item.subcategory_name, index)"
                >
                    {{ item.subcategory_name }}
                </p>
                <FileAction
                    :fileData="fileApprove"
                    :label="item.requirements_name"
                    :showDownloadButton="false"
                    :showUploadButton="false"
                    :documentId="item.document_id"
                    status="client"
                    :hasFile="item.file_path"
                    :documentRemarks="item.document_remarks"
                    @pdf-url="handlePdfUrl"
                    @label="handlePdfTitle"
                    @documentRemarks="handlePdfRemarks"
                />
            </div>
            <div class="flex items-center justify-between mt-3">
                <Pagination
                    :currentPage="record.current_page"
                    :lastPage="record.last_page"
                    :url="routeName"
                    :previousPageUrl="record.prev_page_url"
                    :nextPageUrl="record.next_page_url"
                    :params="params"
                />
            </div>
        </div>
    </div>
</template>
<style scoped>
.danger-btn {
    @apply cursor-pointer text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium text-sm px-5 py-2.5 text-center me-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900;
}
.success-btn {
    @apply cursor-pointer text-white bg-green-600 hover:bg-green-400 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-md text-sm px-5 py-2.5 text-center me-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800;
}
</style>
