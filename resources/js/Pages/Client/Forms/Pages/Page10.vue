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
    fire_safety_certificate: {
        type: null,
        default: null
    },
    health_certificate: {
        type: null,
        default: null
    },
    dti_certificate: {
        type: null,
        default: null
    },
    cedula: {
        type: null,
        default: null
    },
});
</script>

<template>
    <div :class="{ 'hidden': page != 10}">
        <h1 class="text-2xl font-bold mb-2">Requirements for Certificate of Occupancy for Business Permit</h1>
        <p class="p-4 bg-violet-200 mb-3">
            30. BFP Fire Safety Inspection Certificate
        </p>
        <FileAction label="BFP Fire Safety Inspection Certificate" inputId="fire_safety_certificate"
            @file-selected="handleFileSelected"
            @download="() => handleDownload()"
            :showDownloadButton="showDownloadButton"
            :showUploadButton="showUploadButton"
            :hasFile="fire_safety_certificate"
			@pdf-url="handlePdfUrl"
        />
            <p class="p-4 bg-violet-200 mb-3">
            31. Health Certificate
        </p>
        <FileAction label="Health Certificate" inputId="health_certificate"
            @file-selected="handleFileSelected"
            @download="() => handleDownload()"
            :showDownloadButton="showDownloadButton"
            :showUploadButton="showUploadButton"
            :hasFile="health_certificate"
			@pdf-url="handlePdfUrl"
        />
        <p class="p-4 bg-violet-200 mb-3">
            32. Department of Trade and Industry (DTI) Certification
        </p>
        <FileAction label="Department of Trade and Industry (DTI) Certification" inputId="dti_certificate"
            @file-selected="handleFileSelected"
            @download="() => handleDownload()"
            :showDownloadButton="showDownloadButton"
            :showUploadButton="showUploadButton"
            :hasFile="dti_certificate"
			@pdf-url="handlePdfUrl"
        />
        <p class="p-4 bg-violet-200 mb-3">
            33. Community Tax Certificate (Cedula)
        </p>
        <FileAction label="Community Tax Certificate (Cedula)" inputId="cedula"
            @file-selected="handleFileSelected"
            @download="() => handleDownload()"
            :showDownloadButton="showDownloadButton"
            :showUploadButton="showUploadButton"
            :hasFile="cedula"
			@pdf-url="handlePdfUrl"
        />
    </div>
</template>
