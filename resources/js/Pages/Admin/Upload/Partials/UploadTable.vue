<script setup>
import { ref } from "vue";
import PdfContainer from "../../../Components/PdfContainer.vue";
import FileAction from "../../../Components/FileAction.vue";
import Pagination from "../../../../Components/Pagination.vue";
defineProps({
    requirements: [Object, Array],
});
const routeName = "admin.uploads.index";

const pdfUrl = ref("https://example.com/path/to/your/pdf-file.pdf");
const showModal = ref(false);
const toggleModal = () => {
    showModal.value = !showModal.value;
};
const title = ref("");
const handlePdfTitle = ({ label }) => {
    title.value = label;
    console.log(label);
};
const handlePdfUrl = ({ hasFile }) => {
    pdfUrl.value = hasFile;
    showModal.value = true;
    console.log(pdfUrl);
};
</script>

<template>
    <div>
        <PdfContainer
            :pdfUrl="pdfUrl"
            :title="title"
            :show.sync="showModal"
            @update:show="toggleModal"
        />
        <table class="w-full text-sm text-left">
            <thead class="text-md text-gray-700 uppercase">
                <tr>
                    <th class="w-1/5">Category</th>
                    <th class="w-2/5">Subcategory</th>
                    <th class="w-2/5">Requirement Name</th>
                    <th class="w-1/5">Document Type</th>
                    <th class="w-1/5">Template</th>
                </tr>
            </thead>
            <tbody>
                <template
                    v-for="(item, index) in requirements.data"
                    :key="index"
                >
                    <tr class="border-y text-sm text-gray-900">
                        <td class="!py-2">{{ item.category_name }}</td>
                        <td class="!py-2">{{ item.subcategory_name }}</td>
                        <td class="!py-2">{{ item.requirements_name }}</td>
                        <td class="!py-2">{{ item.permit_type_name }}</td>
                        <td class="!py-2">
                            <FileAction
                                :label="item.requirements_name"
                                :title="item.requirements_name"
                                :inputId="item.requirements_id"
                                :showDownloadButton="false"
                                :showUploadButton="false"
                                :hasFile="item.template_file_path"
                                @pdf-url="handlePdfUrl"
                                @label="handlePdfTitle"
                            />
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
        <Pagination
            :currentPage="requirements.current_page"
            :lastPage="requirements.last_page"
            :url="routeName"
            :previousPageUrl="requirements.prev_page_url"
            :nextPageUrl="requirements.next_page_url"
            :params="params"
        />
    </div>
</template>
