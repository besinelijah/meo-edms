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
    perspective_site_devt: {
        type: null,
        default: null
    },
    bldg_plan: {
        type: null,
        default: null
    },
    structural_plan: {
        type: null,
        default: null
    },
    sanitary_plan: {
        type: null,
        default: null
    },
});
</script>

<template>
    <div :class="{ 'hidden': page != 3}">
        <h1 class="text-2xl font-bold mb-2">BUILDING PLANS</h1>
        <p class="p-4 bg-violet-200 mb-3">
            4. Perspective with the Site Development (Signed and sealed by the Architecture and Geodetic Engineer)
        </p>
        <FileAction label="Perspective with the Site Development" inputId="perspective_site_devt"
            @file-selected="handleFileSelected"
            @download="() => handleDownload()"
            :showDownloadButton="showDownloadButton"
            :showUploadButton="showUploadButton"
            :hasFile="perspective_site_devt"
			@pdf-url="handlePdfUrl"
        />
        <p class="p-4 bg-violet-200 mb-3">
            5. Building Plans (Signed and sealed by the Architect/Civil Engineer)
        </p>
        <FileAction label="Building Plans" inputId="bldg_plan"
            @file-selected="handleFileSelected"
            @download="() => handleDownload()"
            :showDownloadButton="showDownloadButton"
            :showUploadButton="showUploadButton"
            :hasFile="bldg_plan"
			@pdf-url="handlePdfUrl"
        />
        <p class="p-4 bg-violet-200 mb-3">
            6. Structural Plans (Signed and sealed by Civil Engineer/Structural Engineer)
        </p>
        <FileAction label="Structural Plans & Details" inputId="structural_plan"
            @file-selected="handleFileSelected"
            @download="() => handleDownload()"
            :showDownloadButton="showDownloadButton"
            :showUploadButton="showUploadButton"
            :hasFile="structural_plan"
			@pdf-url="handlePdfUrl"
        />
        <p class="p-4 bg-violet-200 mb-3">
            7. Sanitary Plans/Plumbing Plans (Signed and sealed by Sanitary Engineer/Master Plumber/Civil Engineer)
        </p>
        <FileAction label="Sanitary Plans/Plumbing Plans" inputId="sanitary_plan"
            @file-selected="handleFileSelected"
            @download="() => handleDownload()"
            :showDownloadButton="showDownloadButton"
            :showUploadButton="showUploadButton"
            :hasFile="sanitary_plan"
			@pdf-url="handlePdfUrl"
        />
    </div>
</template>
