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
    electrical_plan: {
        type: null,
        default: null
    },
    fencing_plan: {
        type: null,
        default: null
    },
    mechanical_plan: {
        type: null,
        default: null
    },
    electronics_plan: {
        type: null,
        default: null
    },
});
</script>

<template>
    <div :class="{ 'hidden': page != 4}">
        <h1 class="text-2xl font-bold mb-2">BUILDING PLANS</h1>
        <p class="p-4 bg-violet-200 mb-3">
            8. Electrical Plans (signed and sealed by Electrical Engineer)
        </p>
        <FileAction label="Electrical Plans	" inputId="electrical_plan"
            @file-selected="handleFileSelected"
            @download="() => handleDownload()"
            :showDownloadButton="showDownloadButton"
            :showUploadButton="showUploadButton"
            :hasFile="electrical_plan"
			@pdf-url="handlePdfUrl"
        />
        <p class="p-4 bg-violet-200 mb-3">
            9. Fencing/Perimeter Fencing Plans (signed and sealed by the Architect/Civil Engineer & Geodetic Engineer)
        </p>
        <FileAction label="Fencing/Perimeter Fencing Plans" inputId="fencing_plan"
            @file-selected="handleFileSelected"
            @download="() => handleDownload()"
            :showDownloadButton="showDownloadButton"
            :showUploadButton="showUploadButton"
            :hasFile="fencing_plan"
			@pdf-url="handlePdfUrl"
        />
        <p class="p-4 bg-violet-200 mb-3">
            10. Mechanical Plan (signed and sealed by Mechanical Engineer)
        </p>
        <FileAction label="Mechanical Plan" inputId="mechanical_plan"
            @file-selected="handleFileSelected"
            @download="() => handleDownload()"
            :showDownloadButton="showDownloadButton"
            :showUploadButton="showUploadButton"
            :hasFile="mechanical_plan"
			@pdf-url="handlePdfUrl"
        />
        <p class="p-4 bg-violet-200 mb-3">
            11. Electronics Plan (signed and sealed by Electronics Engineer)
        </p>
        <FileAction label="Electronics Plan" inputId="electronics_plan"
            @file-selected="handleFileSelected"
            @download="() => handleDownload()"
            :showDownloadButton="showDownloadButton"
            :showUploadButton="showUploadButton"
            :hasFile="electronics_plan"
			@pdf-url="handlePdfUrl"
        />
    </div>
</template>
