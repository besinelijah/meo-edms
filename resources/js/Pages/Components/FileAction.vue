<script setup>
import { useForm } from "@inertiajs/inertia-vue3";
import { onMounted, ref } from "vue";
import { useToast } from "vue-toastification";
const toast = useToast();
import TextInput from "./TextInput.vue";
import axios from "axios";
const props = defineProps({
    label: {
        type: String,
        required: true,
    },
    showDownloadButton: {
        type: Boolean,
        default: true,
    },
    showUploadButton: {
        type: Boolean,
        default: true,
    },
    hasFile: {
        type: null,
        default: null,
    },
    hasUploadedFile: {
        type: null,
        default: false,
    },
    documentId: {
        type: null,
        default: null,
    },
    documentRemarks: {
        type: String,
        default: true,
    },
    downloadableFile: {
        type: null,
        default: null,
    },
    inputId: {
        type: Number,
        default: "upload-file",
    },
    fileData:{
        type: Object,
        default:null
    },
    status:{
        type: String,
        default:null
    }
});
const hasUpload = ref(false);
const fileUploadText = ref("Upload");

const emit = defineEmits([
    "file-selected",
    "pdf-url",
    "download-url",
    "label",
    "documentRemarks",
    "title",
]);

const handleFileChange = (event) => {
    const file = event.target.files[0];
    if (file) {
        emit("file-selected", { file, inputId: props.inputId });
        hasUpload.value = true;
        fileUploadText.value = "File Uploaded";
    }
};

const handleDownload = (data) => {
    emit("download-url", { downloadableFile: props.downloadableFile });
    emit("label", { title: data });
    localStorage.setItem("title", data);
};

const handlePdfUrl = () => {
    emit("pdf-url", { hasFile: props.hasFile });
};

const handlePdfTitle = () => {
    emit("label", { label: props.label });
};

const handlePdfRemarks = () => {
    emit("documentRemarks", { documentRemarks: props.documentRemarks });
};

function getUploadText() {
    if (props.hasUploadedFile == true) {
        return "File Uploaded";
    }

    return "Upload";
}

const removePdfUrl = (inputId) => {
    const file = null;
    hasUpload.value = false;
    emit("file-selected", { file, inputId: inputId });
    fileUploadText.value = "Upload";
    const fileInput = document.getElementById(inputId);
    fileInput.value = null;
};

// remarks
const formData = useForm({
    id: null,
    remarks: null,
    approved:0
});

// Handling approval and disapproval toggles
let isApprove = ref(false);
let disApprove = ref(false);

const approve = () => {
    isApprove.value = !isApprove.value;  // Toggle the value for approval
    disApprove.value = false;  // Ensure disapproval is turned off
    console.log(isApprove.value);
    formData.approved = 1;
};

const dapprove = () => {
    disApprove.value = !disApprove.value;  // Toggle the value for disapproval
    isApprove.value = false;  // Ensure approval is turned off
    formData.approved = 2;

};
const showRemarksModal = ref(false);
const remarks = ref(null); // To store and display the document remarks

const addRemarks = async () => {
    formData.id = props.documentId;
  

try {
        const response = await axios.post("/admin/approval/addDocumentRemarks", {
            id: formData.id,
            remarks: formData.remarks,
            isFileApprove:formData.approved
        });
     
        if (response.data.success) {
            toast.success(response.data.remarks);
            toggleRemarksModal();
        } else {
            console.log(response);
            toast.error(response.data);
        }
    } catch (error) {
        if (error.response && error.response.data) {
            toast.error(error.response.data.remarks || "An error occurred.");
        } else {
            toast.error("An error occurred while adding remarks.");
        }
    } finally {
        toggleRemarksModal(); // Close the modal after request completion
    }
};

function toggleRemarksModal() {
    showRemarksModal.value = !showRemarksModal.value;
}
const isDocumentChecked = ref("");  // This will store the result of isCheck

const isChecks = ref(false); // Use ref to store the result
const isCheck=  async(id)=>{
   if(id!=null){
    const res = await axios.get('/admin/approval/isCheck',{
        params:{
            id: id
        }
    })
    // isDocumentChecked.value = res.data.is_file_approve == 1; 
    if(res.data.is_file_approve == 1){
        isDocumentChecked.value = "check"; 
    }else if(res.data.is_file_approve == 2){
        isDocumentChecked.value = "wrong";     
    }
   }
    // return res.data.is_file_approve;
    // return res.data
}

const getDocumentId = ()=>{
    return props.documentId;
}
const stat = ref(null)
const getStatus = ()=>{
    stat.value = props.status
}
</script>

<template>
    <div class="flex items-center justify-between mb-3">
        <div class="flex-1">{{ label }}</div>
        
        <div class="flex-shrink-0 flex space-x-3">
            <!-- Download Button -->
            <div
                v-if="showDownloadButton"
                @click="handleDownload(label), handlePdfTitle()"
                class="text-white px-3 py-1 rounded cursor-pointer"
                :class="[
                    !downloadableFile
                        ? 'bg-gray-100 cursor-not-allowed pointer-events-none'
                        : 'bg-red-400',
                ]"
            >
                View
            </div>

            <!-- Upload Button -->
            <label
                v-if="showUploadButton"
                :for="inputId"
                class="bg-blue-500 text-white px-3 py-1 rounded cursor-pointer"
            >
                {{ getUploadText() }}
            </label>
{{ getStatus() }}

            <input
                :id="inputId"
                type="file"
                class="hidden"
                @change="handleFileChange"
                accept="application/pdf"
            />
        
            <div v-if="fileData!=null && status==null" style="display: flex; gap: 5px;">
                <div
                v-if="documentId != null"
                class="flex items-center justify-center w-6 h-6 bg-orange-500 rounded-full cursor-pointer"
            >
                <i
                    class="fa-solid fa-inbox text-white"
                    @click="toggleRemarksModal"
                ></i>
            </div>
            <div
                v-if="hasFile != null"
                class="flex items-center justify-center w-6 h-6 bg-yellow-500 rounded-full cursor-pointer"
            >
                <i
                    class="fa-solid fa-eye text-white"
                    @click="handlePdfUrl(), handlePdfTitle(), handlePdfRemarks()"
                ></i>
            </div>
           
            <div
                v-if="(hasFile != null && isCheck(getDocumentId()) && isDocumentChecked=='check')"
                class="flex items-center justify-center w-6 h-6 bg-green-500 rounded-full"
            >
                <i class="fa-solid fa-check text-white text-1xl"></i>
            </div>

            <div
                v-else-if="isCheck(getDocumentId()) && isDocumentChecked=='wrong'"
                class="flex items-center justify-center w-6 h-6 bg-red-500 rounded-full"
            >
                <i class="fa-solid fa-x text-white"></i>
            </div>
            </div>
        
            <div v-else style="display: flex; gap: 5px;">
                <div
                v-if="documentId != null && status==null"
                class="flex items-center justify-center w-6 h-6 bg-orange-500 rounded-full cursor-pointer"
            >
                <i
                    class="fa-solid fa-inbox text-white"
                    @click="toggleRemarksModal"
                ></i>
            </div>
        
            <div
                v-if="hasFile != null"
                class="flex items-center justify-center w-6 h-6 bg-yellow-500 rounded-full cursor-pointer"
            >
                <i
                    class="fa-solid fa-eye text-white"
                    @click="handlePdfUrl(), handlePdfTitle(), handlePdfRemarks()"
                ></i>
            </div>
            <div
                v-if="(hasFile != null && isCheck(getDocumentId()) && isDocumentChecked=='check')"
                class="flex items-center justify-center w-6 h-6 bg-green-500 rounded-full"
            >
                <i class="fa-solid fa-check text-white text-1xl"></i>
            </div>

            <div
                v-else-if="isCheck(getDocumentId()) && isDocumentChecked=='wrong'"
                class="flex items-center justify-center w-6 h-6 bg-red-500 rounded-full"
            >
                <i class="fa-solid fa-x text-white"></i>
            </div>
            <div
                v-if="hasUploadedFile"
                @click="removePdfUrl(inputId)"
                class="flex items-center justify-center w-6 h-6 bg-yellow-500 rounded-full cursor-pointer"
            >
                <i class="fas fa-x text-white"></i>
            </div>
            </div>
        </div>
    </div>

    <!-- Approval and Disapproval Buttons -->
    <div
        v-if="showRemarksModal"
        class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-50"
    >
        <div class="bg-white rounded-lg shadow-lg w-full max-w-xl">
            <form @submit.prevent="addRemarks(), toggleRemarksModal()">
                <div class="flex justify-between items-center p-4 border-b">
                    <h3 class="text-lg font-semibold">Add Remarks</h3>
                    <button
                        @click="toggleRemarksModal"
                        class="text-gray-500 hover:text-gray-700"
                    >
                        <svg
                            class="w-6 h-6"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"
                            ></path>
                        </svg>
                    </button>
                </div>
                <div class="p-4 h-[30vh]">
                    <textarea
                        name="Remarks"
                        class="w-full h-15 border border-gray-300 rounded p-2"
                        v-model="formData.remarks"
                    ></textarea>
                    <div
                        style="
                            display: flex;
                            width: 100%;
                            justify-content: space-between;
                            gap: 10px;
                            padding-top: 10px;
                        "
                    >
                        <!-- Disapprove Button -->
                        <div class="w-[100%]" @click="dapprove">
                            <div
                                class="flex items-center justify-center w-[100%] h-10 rounded-full"
                                :class="{
                                    'bg-red-500': disApprove,
                                    'bg-red-200': !disApprove,
                                }"
                            >
                                <i class="fa-solid fa-x text-white"></i>
                            </div>
                        </div>

                        <!-- Approve Button -->
                        <div class="w-[100%]" @click="approve">
                            <div
                                class="flex items-center justify-center w-[100%] h-10 rounded-full"
                                :class="{
                                    'bg-green-500': isApprove,
                                    'bg-green-200': !isApprove,
                                }"
                            >
                                <i class="fa-solid fa-check text-white text-1xl"></i>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5">
                        <button class="primary-btn">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>
<style scoped>
/* Custom styles */
.bg-blue-500 {
    background-color: #3b82f6;
}

.bg-green-500 {
    background-color: #10b981;
}

.text-white {
    color: #ffffff;
}

.px-3 {
    padding-left: 0.75rem;
    padding-right: 0.75rem;
}

.py-1 {
    padding-top: 0.25rem;
    padding-bottom: 0.25rem;
}

.rounded {
    border-radius: 0.375rem;
}

.cursor-pointer {
    cursor: pointer;
}
</style>
