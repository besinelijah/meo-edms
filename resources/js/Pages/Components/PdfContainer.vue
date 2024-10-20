<template>
    <div v-if="show" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-50">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-4xl">
         
            <div class="flex justify-between items-center p-4 border-b">
                <h3 class="text-lg font-semibold">{{ title }}</h3>
                <span  @click="close" style="cursor: pointer;" class="text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </span>
            </div>
            
            <div class="p-4" v-if="remarks != null">
                <h3 class="text-md italic"><span style="font-weight: bold">Remarks: </span>{{ remarks }}</h3>
            </div>
            <div class="p-4">
                <iframe :src="'/storage/' + pdfUrl" class="w-full h-[70vh]" frameborder="0" ref="pdfIframe"></iframe>
                <div class="flex justify-end mt-4">
                    <button @click="printPdf" class="mr-2 bg-blue-500 text-white px-4 py-2 rounded">Print</button>
                    <button @click="downloadPdf" class="bg-green-500 text-white px-4 py-2 rounded">Download</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, watch, onMounted } from 'vue';

const props = defineProps({
    pdfUrl: {
        type: String,
        required: true,
    },
    title: {
        type: String,
        required: true,
        default: "PDF Viewer"
    },
    remarks: {
        type: String,
        required: true,
        default: null
    },
    show: {
        type: Boolean,
        required: true,
    },
    title: {
        type: String,
        required: true,
    }
});

const emit = defineEmits(['update:show']);
const pdfIframe = ref(null);


// Function to close modal
const close = () => {
    emit('update:show', false);
};


// PDF printing
const printPdf = () => {
    const iframeWindow = pdfIframe.value.contentWindow;
    if (iframeWindow) {
        iframeWindow.focus();
        iframeWindow.print();
    } else {
        console.error("Iframe window is not accessible.");
    }
};

// PDF download
const downloadPdf = () => {
    const link = document.createElement('a');
    link.href = '/storage/' + props.pdfUrl;
    link.download = props.pdfUrl;
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
};
</script>

<style scoped>
/* Optional: Custom styling for the modal */
</style>
