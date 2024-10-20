<!-- Page1.vue -->
<script setup>
import FileAction from '../../../Components/FileAction.vue';

const emit = defineEmits(['file-selected', 'download', ' pdf-url']);

const handleFileSelected = ({file, inputId}) => {
    emit('file-selected', { file, inputId: inputId }); 
};

const handleDownload = (id) => {
    emit('download', id);
};

const handlePdfUrl = ({hasFile}) => {
    emit('pdf-url', { hasFile: hasFile }); 
}

const props = defineProps({
    page: {
      type: String,
    },
    showDownloadButton: {
        type: Boolean,
        default: true
    },
    showUploadButton: {
        type: Boolean,
        default: true
    },
    right_of_way: {
        type: null,
        default: null
    },
    fire_code_reqs: {
        type: null,
        default: null
    },
});
</script>

<template>
    <div :class="{ 'hidden': page != 7}">
        <h1 class="text-2xl font-bold mb-2">CLEARANCES</h1>
        <p class="p-4 bg-violet-200 mb-3">
            20. Right-Of-Way(if the proposed building is along the National Highway-DPWH/Provincial Road-PEO)
        </p>
        <FileAction label="Right-Of-Way" inputId="right_of_way"
            @file-selected="handleFileSelected"
            @download="() => handleDownload()"
            :showDownloadButton="showDownloadButton"
            :showUploadButton="showUploadButton"
            :hasFile="right_of_way"
			@pdf-url="handlePdfUrl"
        />
            <p class="p-4 bg-violet-200 mb-3">
            21. Fire Code & Fire Safety and Code Requirements(Bureau of FireDepartment)
        </p>
        <FileAction label="Fire Code & Fire Safety and Code Requirements" inputId="fire_code_reqs"
            @file-selected="handleFileSelected"
            @download="() => handleDownload()"
            :showDownloadButton="showDownloadButton"
            :showUploadButton="showUploadButton"
            :hasFile="fire_code_reqs"
			@pdf-url="handlePdfUrl"
        />
    </div>
</template>
