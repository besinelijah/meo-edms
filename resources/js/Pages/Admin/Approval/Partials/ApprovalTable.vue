<script setup>
import { ref, computed, onMounted } from "vue";
import moment from "moment";
import { useForm } from "@inertiajs/inertia-vue3";
import Pagination from "@/Components/Pagination.vue";
import TextInput from "../../../Components/TextInput.vue";
import axios from "axios";

// Form for pagination
const form = useForm({
    page: 1,
});

// Route name
const routeName = "admin.approval.index";

// Function to change the page
const changePage = (page) => {
    form.page = page;
};

// Format the date
function formatDate(date) {
    return moment(date).format("MMMM DD, YYYY h:mm a");
}

// Get the type of permit
function getType(type) {
    var text = "";
    switch (type) {
        case "1":
            text = "Business Permit (New)";
            break;
        case "2":
            text = "Building Permit";
            break;
        default:
            text = "Business Permit (Renewal)";
            break;
    }
    return text;
}

// Define props
const props = defineProps({
    queue: [Object, Array],
});

// Reactive variables
const openMenuIndex = ref(null);
const toggleMenu = (index) => {
    openMenuIndex.value = openMenuIndex.value === index ? null : index;
};

// Form data for changing status
const formData = useForm({
    id: null,
    status: null,
    type: null,
    isNew: null,
    clientId: null,
    remarks: null,
    data: null,
});

// Function to change status
function changeStatus(id, status, type, isSubmit = true, remarks = null, data) {
    formData.id = id;
    formData.status = status;
    formData.type = type;
    formData.remarks = remarks;
    formData.data = data;

    if (isSubmit) {
        submitForm();
    }
}

// Function to submit the form
function submitForm() {
    formData.post(route("admin.approval.changestatus"));
}

// Function to get a record
function getRecord(id, type, clientId) {
    localStorage.setItem("localID", id);
    localStorage.setItem("localtype", type);
    localStorage.setItem("clientID", clientId);
    if (
        localStorage.getItem("localID") ||
        localStorage.getItem("localtype") ||
        localStorage.getItem("clientID")
    ) {
        formData.id = localStorage.getItem("localID");
        formData.type = localStorage.getItem("localtype");
        formData.clientId = localStorage.getItem("clientID");
    } else {
        formData.id = id;
        formData.type = type;
        formData.clientId = clientId;
    }

    formData.post("/admin/approval/getRecord");
}

// Toggle reject modal
const showRejectModal = ref(false);
function toggleRejectModal() {
    showRejectModal.value = !showRejectModal.value;
}
const searchQuery = ref(""); // Search query

// Get the name of the person who checked the record
function checkedBy(checkedBy) {
    if (checkedBy != null) {
        return checkedBy.lname + ", " + checkedBy.fname + " " + checkedBy.mname;
    }
    return "";
}
const inputText = ref("");
const hasContent = ref(true);
const searchData = ref([]);

const handleInput = async (e) => {
    const response = await axios.get("approval/search", {
        params: {
            search: inputText.value,
        },
    });
    console.log(response.data);
    hasContent.value = response.data.length > 0;
    searchData.value = response.data;
    if(inputText.value.length<1){
        hasContent.value=0
    }
};
// Search bar functionality

// Computed property to filter the queue based on search query
const filteredQueue = computed(() => {
    if (!searchQuery.value) {
        return props.queue.data;
    }

    // Filter queue by client name or project title
    return props.queue.data.filter((item) => {
        const clientName = `${item.client.lname}, ${item.client.fname} ${item.client.mname}`;
        return (
            clientName
                .toLowerCase()
                .includes(searchQuery.value.toLowerCase()) ||
            item.project_title
                .toLowerCase()
                .includes(searchQuery.value.toLowerCase())
        );
    });
});

onMounted(() => {
    if (performance.navigation.type === performance.navigation.TYPE_RELOAD) {
        if (
            localStorage.getItem("localID") ||
            localStorage.getItem("localtype") ||
            localStorage.getItem("clientID")
        ) {
            formData.id = localStorage.getItem("localID");
            formData.type = localStorage.getItem("localtype");
            formData.clientId = localStorage.getItem("clientID");
            formData.post("/admin/approval/getRecord");
        }
    }
    hasContent.value = inputText.value.length > 0;
});
</script>

<template>
    <div>
        <!-- Search Bar -->
        <div class="mb-4">
            <input
                type="text"
                v-model="inputText"
                @input="handleInput"
                placeholder="Search by owner or project title"
                class="w-full p-2 border rounded"
            />
        </div>
        <div v-if="hasContent">
            <!-- Table -->
            <div  style="height: 350px; overflow-y: scroll;">
				<table class="w-full text-sm text-left">
                <thead class="text-md text-gray-700 uppercase">
                    <tr>
                        <th class="w-[170px]">Type of Permit</th>
                        <th>Name of Owner</th>
                        <th>Project Title</th>
                        <th>Application Date</th>
                        <th>Remarks</th>
                        <th>Status</th>
                        <th>Checked By</th>
                        <th>View</th>
                    </tr>
                </thead>
                <tbody >
                    <template
                        v-for="(item, index) in searchData"
                        :key="index"
                    >
                        <tr class="border-y text-sm text-gray-900">
                            <td class="!py-2">{{ getType(item.type) }}</td>
                            <td class="!py-2">
                                {{ item.client.lname }}, {{ item.client.fname }}
                                {{ item.client.mname }}
                            </td>
                            <td class="!py-2">
                                {{ item.project_title.toUpperCase() }}
                            </td>
                            <td class="!py-2">
                                {{ formatDate(item.created_at) }}
                            </td>
                            <td class="!py-2">{{ item.remarks }}</td>
                            <td class="!py-2 whitespace-nowrap">
                                <span
                                    class="p-2 rounded"
                                    :class="{
                                        'bg-green-100':
                                            item.status == 'Approved',
                                        'bg-red-100': item.status == 'Rejected',
                                        'bg-yellow-100':
                                            item.status == 'Pending',
                                        'bg-orange-100':
                                            item.status == 'Returned',
                                    }"
                                >
                                    <i
                                        class="mr-2"
                                        :class="{
                                            'fas fa-check-circle text-green-500':
                                                item.status == 'Approved',
                                            'fas fa-times-circle text-red-500':
                                                item.status == 'Rejected',
                                            'fas fa-hourglass-half text-yellow-500':
                                                item.status == 'Pending',
                                            'fas fa-arrow-rotate-left text-orange-500':
                                                item.status == 'Returned',
                                        }"
                                    ></i>
                                    {{ item.status }}
                                </span>
                            </td>
                            <td class="!py-2">
                                {{ checkedBy(item.checked_by) }}
                            </td>
                            <td class="!py-2">
                                <button
                                    @click="
                                        getRecord(
                                            item.id,
                                            item.type,
                                            item.client_id
                                        )
                                    "
                                    class="p-2 text-gray-600 hover:text-gray-900 relative"
                                >
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
          
			</div>
            <!-- No data available message -->
            <div v-if="searchData.length<1" class="w-full bg-gray-100 text-center text-sm p-5">
                No data available
            </div>
            <!-- Pagination -->
		
        </div>
	   <div v-else-if="inputText.length>1 && !hasContent">
            <!-- Table -->
            <table class="w-full text-sm text-left">
                <thead class="text-md text-gray-700 uppercase">
                    <tr>
                        <th class="w-[170px]">Type of Permit</th>
                        <th>Name of Owner</th>
                        <th>Project Title</th>
                        <th>Application Date</th>
                        <th>Remarks</th>
                        <th>Status</th>
                        <th>Checked By</th>
                        <th>View</th>
                    </tr>
                </thead>
                
            </table>

			<!-- No data available message -->
            <div
                v-if="inputText.length>1 && !hasContent"
                class="w-full bg-gray-100 text-center text-sm p-5"
            >
                No data available
            </div>
            <!-- Pagination -->
            <Pagination
                v-if="queue.total > 1 && queue.last_page > 1"
                :currentPage="queue.current_page"
                :lastPage="queue.last_page"
                @page-changed="changePage(queue.current_page)"
                :url="routeName"
                :previousPageUrl="queue.prev_page_url"
                :nextPageUrl="queue.next_page_url"
            />
        </div>	
        <div v-else>
            <!-- Table -->
            <table class="w-full text-sm text-left">
                <thead class="text-md text-gray-700 uppercase">
                    <tr>
                        <th class="w-[170px]">Type of Permit</th>
                        <th>Name of Owner</th>
                        <th>Project Title</th>
                        <th>Application Date</th>
                        <th>Remarks</th>
                        <th>Status</th>
                        <th>Checked By</th>
                        <th>View</th>
                    </tr>
                </thead>
                <tbody >
                    <template
                        v-for="(item, index) in filteredQueue"
                        :key="index"
                    >
                        <tr class="border-y text-sm text-gray-900">
                            <td class="!py-2">{{ getType(item.type) }}</td>
                            <td class="!py-2">
                                {{ item.client.lname }}, {{ item.client.fname }}
                                {{ item.client.mname }}
                            </td>
                            <td class="!py-2">
                                {{ item.project_title.toUpperCase() }}
                            </td>
                            <td class="!py-2">
                                {{ formatDate(item.created_at) }}
                            </td>
                            <td class="!py-2">{{ item.remarks }}</td>
                            <td class="!py-2 whitespace-nowrap">
                                <span
                                    class="p-2 rounded"
                                    :class="{
                                        'bg-green-100':
                                            item.status == 'Approved',
                                        'bg-red-100': item.status == 'Rejected',
                                        'bg-yellow-100':
                                            item.status == 'Pending',
                                        'bg-orange-100':
                                            item.status == 'Returned',
                                    }"
                                >
                                    <i
                                        class="mr-2"
                                        :class="{
                                            'fas fa-check-circle text-green-500':
                                                item.status == 'Approved',
                                            'fas fa-times-circle text-red-500':
                                                item.status == 'Rejected',
                                            'fas fa-hourglass-half text-yellow-500':
                                                item.status == 'Pending',
                                            'fas fa-arrow-rotate-left text-orange-500':
                                                item.status == 'Returned',
                                        }"
                                    ></i>
                                    {{ item.status }}
                                </span>
                            </td>
                            <td class="!py-2">
                                {{ checkedBy(item.checked_by) }}
                            </td>
                            <td class="!py-2">
                                <button
                                    @click="
                                        getRecord(
                                            item.id,
                                            item.type,
                                            item.client_id
                                        )
                                    "
                                    class="p-2 text-gray-600 hover:text-gray-900 relative"
                                >
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>

			<!-- No data available message -->
            <div
                v-if="queue.length < 1"
                class="w-full bg-gray-100 text-center text-sm p-5"
            >
                No data available
            </div>
            <!-- Pagination -->
            <Pagination
                v-if="queue.total > 1 && queue.last_page > 1"
                :currentPage="queue.current_page"
                :lastPage="queue.last_page"
                @page-changed="changePage(queue.current_page)"
                :url="routeName"
                :previousPageUrl="queue.prev_page_url"
                :nextPageUrl="queue.next_page_url"
            />
        </div>
        <!-- Reject Modal -->
        <div
            v-if="showRejectModal"
            class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-50"
        >
            <div class="bg-white rounded-lg shadow-lg w-full max-w-xl">
                <form @submit.prevent="submitForm(), toggleRejectModal()">
                    <div class="flex justify-between items-center p-4 border-b">
                        <h3 class="text-lg font-semibold">
                            Reject Application Form
                        </h3>
                        <button
                            @click="toggleRejectModal"
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
                    <div class="p-4 h-[20vh]">
                        <TextInput
                            name="Remarks"
                            v-model:modelValue="formData.remarks"
                        ></TextInput>
                        <div class="mt-5">
                            <button class="primary-btn">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
