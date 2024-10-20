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
    tct: {
        type: null,
        default: null
    },
    tax_declaration: {
        type: null,
        default: null
    },
    prop_tax_receipt: {
        type: null,
        default: null
    },
    contract_lease: {
        type: null,
        default: null
    },
    deed_of_sale: {
        type: null,
        default: null
    },
    contract_sale: {
        type: null,
        default: null
    },
    lot_plan: {
        type: null,
        default: null
    },
});
</script>

<template>
    <div :class="{ 'hidden': page != 2}">
        <p class="p-4 bg-violet-200 mb-3">
            2. a.) In case the applicant is the registered owner of the lot:
        </p>
        <FileAction label="1. Certified true copy of TCT" inputId="tct"
            @file-selected="handleFileSelected"
            @download="() => handleDownload()"
            :showDownloadButton="showDownloadButton"
            :showUploadButton="showUploadButton"
            :hasFile="tct"
            @pdf-url="handlePdfUrl"
        />
        <FileAction label="2. Tax Declaration (Updated & Authenticated from Assessors Office)" inputId="tax_declaration"
            @file-selected="handleFileSelected"
            @download="() => handleDownload()"
            :showDownloadButton="showDownloadButton"
            :showUploadButton="showUploadButton"
            :hasFile="tax_declaration"
            @pdf-url="handlePdfUrl"
        />
        <FileAction label="3. Current Real Property Tax Receipts" inputId="prop_tax_receipt"
            @file-selected="handleFileSelected"
            @download="() => handleDownload()"
            :showDownloadButton="showDownloadButton"
            :showUploadButton="showUploadButton"
            :hasFile="prop_tax_receipt"
            @pdf-url="handlePdfUrl"
        />
        <p class="p-4 bg-violet-200 mb-3">
            b.) In case the applicant is not the registered owner of the lot:
        </p>
        <FileAction label="1. Duly notarized copy of the Contract of Lease" inputId="contract_lease"
            @file-selected="handleFileSelected"
            @download="() => handleDownload()"
            :showDownloadButton="showDownloadButton"
            :showUploadButton="showUploadButton"
            :hasFile="contract_lease"
            @pdf-url="handlePdfUrl"
        />
        <FileAction label="2. Duly notarized copy of Deed of Absolute Sale" inputId="deed_of_sale"
            @file-selected="handleFileSelected"
            @download="() => handleDownload()"
            :showDownloadButton="showDownloadButton"
            :showUploadButton="showUploadButton"
            :hasFile="deed_of_sale"
            @pdf-url="handlePdfUrl"
        />
        <FileAction label="3. Duly notarized of the Contract Sale" inputId="contract_sale"
            @file-selected="handleFileSelected"
            @download="() => handleDownload()"
            :showDownloadButton="showDownloadButton"
            :showUploadButton="showUploadButton"
            :hasFile="contract_sale"
            @pdf-url="handlePdfUrl"
        />
        <p class="p-4 bg-violet-200 mb-3">
            3. Lot Plan (Signed and sealed by geodetic Engineer)
        </p>
        <FileAction label="Lot Plan" inputId="lot_plan"
            @file-selected="handleFileSelected"
            @download="() => handleDownload()"
            :showDownloadButton="showDownloadButton"
            :showUploadButton="showUploadButton"
            :hasFile="lot_plan"
            @pdf-url="handlePdfUrl"
        />
    </div>
</template>
