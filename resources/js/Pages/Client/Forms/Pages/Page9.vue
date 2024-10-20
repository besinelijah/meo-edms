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
    as_built_plan: {
        type: null,
        default: null
    },
    construction_logbook: {
        type: null,
        default: null
    },
    completion_certificate: {
        type: null,
        default: null
    },
    contract_lease_clearance: {
        type: null,
        default: null
    },
});
</script>

<template>
    <div :class="{ 'hidden': page != 9}">
        <h1 class="text-2xl font-bold mb-2">Requirements for Certificate of Occupancy for Business Permit</h1>
        <p class="p-4 bg-violet-200 mb-3">
            26. As-Built Plan (signed, sealed of Architect or Civil Engineer)
        </p>
        <FileAction label="As-Built Plan" inputId="as_built_plan"
            @file-selected="handleFileSelected"
            @download="() => handleDownload()"
            :showDownloadButton="showDownloadButton"
            :showUploadButton="showUploadButton"
            :hasFile="as_built_plan"
			@pdf-url="handlePdfUrl"
        />
            <p class="p-4 bg-violet-200 mb-3">
            27. Construction Log Book
        </p>
        <FileAction label="Construction Log Book" inputId="construction_logbook"
            @file-selected="handleFileSelected"
            @download="() => handleDownload()"
            :showDownloadButton="showDownloadButton"
            :showUploadButton="showUploadButton"
            :hasFile="construction_logbook"
			@pdf-url="handlePdfUrl"
        />
        <p class="p-4 bg-violet-200 mb-3">
            28. Certificate of Completion
        </p>
        <FileAction label="Certificate of Completion" inputId="completion_certificate"
            @file-selected="handleFileSelected"
            @download="() => handleDownload()"
            :showDownloadButton="showDownloadButton"
            :showUploadButton="showUploadButton"
            :hasFile="completion_certificate"
			@pdf-url="handlePdfUrl"
        />
        <p class="p-4 bg-violet-200 mb-3">
            29. Contract of Lease
        </p>
        <FileAction label="Contract of Lease" inputId="contract_lease_clearance"
            @file-selected="handleFileSelected"
            @download="() => handleDownload()"
            :showDownloadButton="showDownloadButton"
            :showUploadButton="showUploadButton"
            :hasFile="contract_lease_clearance"
			@pdf-url="handlePdfUrl"
        />
    </div>
</template>
