<script setup>
import FileAction from '../../../Components/FileAction.vue';

const emit = defineEmits(['file-selected', 'download-url', ' pdf-url']);

const handleFileSelected = ({file, inputId}) => {
    emit('file-selected', { file, inputId: inputId }); 
};

const handleDownload = ({downloadableFile}) => {
    emit('download-url', {downloadableFile: downloadableFile});
};

const handlePdfUrl = ({hasFile}) => {
    emit('pdf-url', { hasFile: hasFile }); 
}
// const bldgFormdownload = '/storage/templates/building_permit.pdf';
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
    bldgFormdownload: {
        type: null,
        default: null
    },
    bldgForm: {
        type: null,
        default: null
    },
    elecForm: {
        type: null,
        default: null
    },
    sanitaryForm: {
        type: null,
        default: null
    },
    fencingPermit: {
        type: null,
        default: null
    },
    mechanicalPermit: {
        type: null,
        default: null
    },
    zoningClearance: {
        type: null,
        default: null
    },
});
</script>

<template>
    <div :class="{ 'hidden': page != 1 }">
        <p class="p-4 bg-violet-200 mb-3">
            1. Accomplished Application Forms -
            (Building, Electrical & Sanitary/Plumbing Permit, Fencing, Mechanical (if required) & Zoning/Locational
            Clearance)
        </p>
        <FileAction label="1. Building forms" inputId="bldg_form"
            @file-selected="handleFileSelected"
            :showDownloadButton="showDownloadButton"
            :showUploadButton="showUploadButton"
            :hasFile="bldgForm"
            :downloadableFile="bldgFormdownload"
            @download-url="handleDownload" 
            @pdf-url="handlePdfUrl"
        />
        <FileAction label="2. Electrical forms" inputId="electrical_form"
            @file-selected="handleFileSelected"
            :showDownloadButton="showDownloadButton"
            :showUploadButton="showUploadButton"
            :hasFile="elecForm"
            :downloadableFile="bldgFormdownload"
            @download-url="handleDownload" 
            @pdf-url="handlePdfUrl"
        />
        <FileAction label="3. Sanitary/ Plumbing Permit" inputId="sanitary_permit"
            @file-selected="handleFileSelected"
            :showDownloadButton="showDownloadButton"
            :showUploadButton="showUploadButton"
            :hasFile="sanitaryForm"
            :downloadableFile="bldgFormdownload"
            @download-url="handleDownload"
            @pdf-url="handlePdfUrl"
        />
        <FileAction label="4. Fencing Permit" inputId="fencing_form"
            @file-selected="handleFileSelected"
            :showDownloadButton="showDownloadButton"
            :showUploadButton="showUploadButton"
            :hasFile="fencingPermit"
            :downloadableFile="bldgFormdownload"
            @download-url="handleDownload"
            @pdf-url="handlePdfUrl"
        />
        <FileAction label="5. Mechanical Permit" inputId="mechanical_permit"
            @file-selected="handleFileSelected"
            :showDownloadButton="showDownloadButton"
            :showUploadButton="showUploadButton"
            :hasFile="mechanicalPermit"
            :downloadableFile="bldgFormdownload"
            @download-url="handleDownload"
            @pdf-url="handlePdfUrl"
        />
        <FileAction label="6. Zoning/ Locational Clearance" inputId="zoning_location_clearance"
            @file-selected="handleFileSelected"
            :showDownloadButton="showDownloadButton"
            :showUploadButton="showUploadButton"
            :hasFile="zoningClearance"
            :downloadableFile="bldgFormdownload"
            @download-url="handleDownload"
            @pdf-url="handlePdfUrl"
        />
    </div>
</template>
