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
    brgy_bussiness_clearance: {
        type: null,
        default: null
    },
    zoning_clearance_certificate: {
        type: null,
        default: null
    },
    bldg_pictures: {
        type: null,
        default: null
    },
    affidavit_of_undertaking: {
        type: null,
        default: null
    },
});
</script>

<template>
    <div :class="{ 'hidden': page != 8}">
        <h1 class="text-2xl font-bold mb-2">Requirements for Certificate of Occupancy for Business Permit</h1>
        <p class="p-4 bg-violet-200 mb-3">
            22. Barangay Business Clearance
        </p>
        <FileAction label="Barangay Business Clearance" inputId="brgy_bussiness_clearance"
            @file-selected="handleFileSelected"
            @download="() => handleDownload()"
            :showDownloadButton="showDownloadButton"
            :showUploadButton="showUploadButton"
            :hasFile="brgy_bussiness_clearance"
			@pdf-url="handlePdfUrl"
        />
            <p class="p-4 bg-violet-200 mb-3">
            23. Zoning Clearance Certificate Locational Clearance
        </p>
        <FileAction label="Zoning Clearance Certificate Locational Clearance" inputId="zoning_clearance_certificate"
            @file-selected="handleFileSelected"
            @download="() => handleDownload()"
            :showDownloadButton="showDownloadButton"
            :showUploadButton="showUploadButton"
            :hasFile="zoning_clearance_certificate"
			@pdf-url="handlePdfUrl"
        />
        <p class="p-4 bg-violet-200 mb-3">
            24. Pictures of Building(exterior & interior)
        </p>
        <FileAction label="Pictures of Building" inputId="bldg_pictures"
            @file-selected="handleFileSelected"
            @download="() => handleDownload()"
            :showDownloadButton="showDownloadButton"
            :showUploadButton="showUploadButton"
            :hasFile="bldg_pictures"
			@pdf-url="handlePdfUrl"
        />
        <p class="p-4 bg-violet-200 mb-3">
            25. Affidavit of Undertaking
        </p>
        <FileAction label="Affidavit of Undertaking" inputId="affidavit_of_undertaking"
            @file-selected="handleFileSelected"
            @download="() => handleDownload()"
            :showDownloadButton="showDownloadButton"
            :showUploadButton="showUploadButton"
            :hasFile="affidavit_of_undertaking"
			@pdf-url="handlePdfUrl"
        />
    </div>
</template>
