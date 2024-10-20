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
    structural_design: {
        type: null,
        default: null
    },
    material_cost_estimate: {
        type: null,
        default: null
    },
    construction_specs: {
        type: null,
        default: null
    },
    logbook: {
        type: null,
        default: null
    },
});
</script>

<template>
    <div :class="{ 'hidden': page != 5}">
        <h1 class="text-2xl font-bold mb-2">SUPPORTING DOCUMENTS</h1>
        <p class="p-4 bg-violet-200 mb-3">
            12. Structural Design (signed and sealed by Civil/Structural Engineer)
        </p>
        <FileAction label="Structural Design" inputId="structural_design"
            @file-selected="handleFileSelected"
            @download="() => handleDownload()"
            :showDownloadButton="showDownloadButton"
            :showUploadButton="showUploadButton"
            :hasFile="structural_design"
			@pdf-url="handlePdfUrl"
        />
        <p class="p-4 bg-violet-200 mb-3">
            13. Bill of Materials and Cost Estimate (signed and sealed by the Architect/Civil Engineer)
        </p>
        <FileAction label="Bill of Materials and Cost Estimate	" inputId="material_cost_estimate"
            @file-selected="handleFileSelected"
            @download="() => handleDownload()"
            :showDownloadButton="showDownloadButton"
            :showUploadButton="showUploadButton"
            :hasFile="material_cost_estimate"
			@pdf-url="handlePdfUrl"
        />
        <p class="p-4 bg-violet-200 mb-3">
            14. Construction Specification (signed and sealed by Architecture/Civil Engineer)
        </p>
        <FileAction label="Construction Specification" inputId="construction_specs"
            @file-selected="handleFileSelected"
            @download="() => handleDownload()"
            :showDownloadButton="showDownloadButton"
            :showUploadButton="showUploadButton"
            :hasFile="construction_specs"
			@pdf-url="handlePdfUrl"
        />
        <p class="p-4 bg-violet-200 mb-3">
            15. Log-Book (signed and sealed by Architect/Civil Engineering)
        </p>
        <FileAction label="Log-Book" inputId="logbook"
            @file-selected="handleFileSelected"
            @download="() => handleDownload()"
            :showDownloadButton="showDownloadButton"
            :showUploadButton="showUploadButton"
            :hasFile="logbook"
			@pdf-url="handlePdfUrl"
        />
    </div>
</template>
