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
    brgy_clearance: {
        type: null,
        default: null
    },
    zoning_clearance: {
        type: null,
        default: null
    },
    locational_clearance: {
        type: null,
        default: null
    },
    environmental_certificate: {
        type: null,
        default: null
    },
});
</script>

<template>
    <div :class="{ 'hidden': page != 6}">
        <h1 class="text-2xl font-bold mb-2">CLEARANCES</h1>
        <p class="p-4 bg-violet-200 mb-3">
            16. Barangay Clearance (to Construct & Certify that the applicants is the legitimate owner of the lot)
        </p>
        <FileAction label="Barangay Clearance" inputId="brgy_clearance"
            @file-selected="handleFileSelected"
            @download="() => handleDownload()"
            :showDownloadButton="showDownloadButton"
            :showUploadButton="showUploadButton"
            :hasFile="brgy_clearance"
			@pdf-url="handlePdfUrl"
        />
        <p class="p-4 bg-violet-200 mb-3">
            17. Zoning Clearance
        </p>
        <FileAction label="Zoning Clearance" inputId="zoning_clearance"
            @file-selected="handleFileSelected"
            @download="() => handleDownload()"
            :showDownloadButton="showDownloadButton"
            :showUploadButton="showUploadButton"
            :hasFile="zoning_clearance"
			@pdf-url="handlePdfUrl"
        />
        <p class="p-4 bg-violet-200 mb-3">
            18. Locational Clearance
        </p>
        <FileAction label="Locational Clearance" inputId="locational_clearance"
            @file-selected="handleFileSelected"
            @download="() => handleDownload()"
            :showDownloadButton="showDownloadButton"
            :showUploadButton="showUploadButton"
            :hasFile="locational_clearance"
			@pdf-url="handlePdfUrl"
        />
        <p class="p-4 bg-violet-200 mb-3">
            19. Environmental Clearance Certificate(only required for piggery, poultry, rice mill, cockfighting arena, warehouse, etc.)
        </p>
        <FileAction label="Environmental Clearance Certificate" inputId="environmental_certificate"
            @file-selected="handleFileSelected"
            @download="() => handleDownload()"
            :showDownloadButton="showDownloadButton"
            :showUploadButton="showUploadButton"
            :hasFile="environmental_certificate"
			@pdf-url="handlePdfUrl"
        />
    </div>
</template>
