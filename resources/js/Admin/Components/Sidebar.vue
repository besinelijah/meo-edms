<script setup>
import { Link, usePage } from "@inertiajs/inertia-vue3";
import { computed, ref, onMounted } from "vue";

const meoImg = "/storage/images/meo.png";
const { url } = usePage();
const isActiveRoute = (baseRoute) => {
    return computed(() => {
        const baseUrl = url.value;
        const urlWithoutAdmin = baseUrl.replace("/admin/", "");
        return urlWithoutAdmin.startsWith(baseRoute);
    });
};
const InboxCount = ref(0);
const isDashboardActive = isActiveRoute("dashboard");
const isDocumentActive = isActiveRoute("documents");
const isUploadActive = isActiveRoute("uploads");
const isRequestActive = isActiveRoute("requests");
const isApprovalActive = isActiveRoute("approval");
const isHistoryActive = isActiveRoute("history");

const fetchInboxCount = async () => {
    await axios.get(route("inbox.count")).then((response) => {
        console.log(response.data);
        InboxCount.value = response.data;
    });
};
const clear = () => {
    localStorage.clear();
};
onMounted(() => {
    fetchInboxCount();
});
</script>
<template>
    <div class="px-8 py-2 text-3xl font-bold bg-slate-800">
        <img
            class="w-full h-20 object-cover cursor-pointer"
            :src="meoImg"
            alt="MEO"
        />
    </div>
    <nav class="flex-1 flex flex-col pt-1 px-2 m-0">
        <ul class="font-medium w-full">
            <li>
                <Link
                    @click="clear"
                    :href="route('admin.dashboard')"
                    :class="{ 'bg-slate-800': isDashboardActive }"
                    class="nav-link w-full"
                >
                    <i class="fas fa-chart-pie w-5 h-5 text-center"></i>
                    <span class="ms-3">Dashboard</span>
                </Link>
            </li>
            <li>
                <Link
                    @click="clear"
                    :href="route('admin.documents.index')"
                    :class="{ 'bg-slate-800': isDocumentActive }"
                    class="nav-link"
                >
                    <i class="fas fa-file-contract w-5 h-5 text-center"></i>
                    <span class="ms-3">Requirements Library</span>
                </Link>
            </li>
            <li>
                <Link
                    @click="clear"
                    :href="route('admin.uploads.index')"
                    :class="{ 'bg-slate-800': isUploadActive }"
                    class="nav-link"
                >
                    <i class="fas fa-upload w-5 h-5 text-center"></i>
                    <span class="ms-3">Upload Files</span>
                </Link>
            </li>
            <li>
                <Link
                    @click="clear"
                    :href="route('admin.requests.index')"
                    :class="{ 'bg-slate-800': isRequestActive }"
                    class="nav-link"
                >
                    <i class="fas fa-file-arrow-down w-5 h-5 text-center"></i>
                    <span class="ms-3">Document Request</span>
                </Link>
            </li>
            <li>
                <Link
                    @click="clear"
                    :href="route('admin.approval.index')"
                    :class="{ 'bg-slate-800': isApprovalActive }"
                    class="nav-link"
                >
                    <i class="fas fa-circle-check w-5 h-5 text-center"></i>
                    <span class="ms-3">Approval Queue</span>
                </Link>
            </li>
            <li>
                <Link
                    @click="clear"
                    :href="route('inbox.index')"
                    :class="{ 'bg-slate-800': route().current('inbox.*') }"
                    class="nav-link"
                >
                    <i class="fas fa-envelope w-5 h-5 text-center"></i>
                    <span class="ms-3">Inbox</span>
                    <span
                        v-if="InboxCount > 0"
                        class="inline-flex items-center justify-center w-5 h-5 ml-auto text-xs font-semibold text-red-800 bg-red-200 rounded-full"
                    >
                        {{ InboxCount }}
                    </span>
                </Link>
            </li>
            <li>
                <Link
                    @click="clear"
                    :href="route('admin.history.index')"
                    :class="{ 'bg-slate-800': isHistoryActive }"
                    class="nav-link"
                >
                    <i class="fas fa-clock-rotate-left w-5 h-5 text-center"></i>
                    <span class="ms-3">History</span>
                </Link>
            </li>
        </ul>
    </nav>
    <div class="p-4 text-center">
        <!-- <button @click="logout" class="w-full bg-red-500 text-white py-2 rounded hover:bg-red-600"> -->
        <Link
            @click="clear"
            :href="route('logout')"
            method="post"
            as="button"
            type="button"
            class="text-center w-full bg-red-500 text-white py-2 rounded hover:bg-red-600"
        >
            {{ "Logout" }}
        </Link>
    </div>
</template>
