<script setup>
import ClientLayout from '../../Shared/ClientLayout.vue';
import moment from 'moment';
import { useForm, usePage } from "@inertiajs/inertia-vue3";
import { onMounted } from 'vue';

defineOptions({ layout: ClientLayout });
const props = defineProps({
    notification: Array
});
const userId = usePage().props.value.auth.user.id;
const formatDate = (date) => {
    return moment(date).format('MMMM DD, YYYY, h:mm A');
};

const formData = useForm({
	id: null,
	status: null,
	type: null,
	remarks: null
});

const listenForNotifications = () => {
	Echo.private(`App.Models.User.${userId}`)
		.notification((notification) => {
			if (notification.data) {
                props.notification.unshift(notification.data);
            }
		});
};

onMounted(() => {
    listenForNotifications();
})

function getStatus(status) {
    return "Status: " + status + '.'
}
</script>

<template>
    <div class="w-full max-w-4xl mx-auto px-4 py-6">
        <Head title="Notifications" />
        <h1 class="text-2xl font-bold mb-4 text-center">Notifications</h1>
        <hr class="border-gray-300 mb-6" />
        <div class="space-y-4">
            <a
                :href="route('notification.getrecord', item.id)"
                v-for="(item, index) in props.notification"
                :key="index"
                class="block p-4 border rounded-lg shadow-md"
                :class="{
                    'bg-white hover:bg-gray-200': item.is_viewed,
                    'bg-slate-400 hover:bg-gray-300': !item.is_viewed
                }"
            >
                <div  class="flex flex-col md:flex-row items-start md:items-center justify-between cursor-pointer">
                    <span class="font-medium text-lg">{{ item.description }} {{ getStatus(item.application_form.status) }}</span>
                    <small class="text-gray-500">{{ formatDate(item.created_at) }}</small>
                </div>
            </a>
        </div>
    </div>
</template>

<style scoped>
.card {
    padding: 1rem;
    border: 1px solid #e2e8f0;
    border-radius: 0.375rem;
    background-color: #ffffff;
    box-shadow: 0 0 1rem rgba(0, 0, 0, 0.1);
}
.card span {
    font-size: 1rem;
    font-weight: 500;
}
.card small {
    color: #6b7280;
}
</style>
