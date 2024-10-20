<script setup>
import { usePage } from '@inertiajs/inertia-vue3';
import { computed, ref, onMounted } from 'vue';
import axios from 'axios';
import { useToast } from 'vue-toastification'

const { url } = usePage();
const toast = useToast();
const isActiveRoute = (baseRoute) => {
  return computed(() => url.value.startsWith(baseRoute));
};
const userId = usePage().props.value.auth.user.id;
const notificationCount = ref(0);
const InboxCount = ref(0);
const isDocumentViewActive = isActiveRoute('/documentview');
const isApplicationFormActive = isActiveRoute('/applicationform');
const isSubmittedFormActive = isActiveRoute('/my-application-forms');
const isInboxActive = isActiveRoute('/inbox');
const isNotificationActive = isActiveRoute('/notifications');
const meoImg = '/storage/images/meo.png';

const fetchNotificationCount = () => {
  axios.get(route('notification.count'))
    .then((response) => {
      notificationCount.value = response.data;
    });
};

const fetchInboxCount = async() => {
  await axios.get(route('inbox.count'))
    .then((response) => {
		console.log(response.data);
		InboxCount.value = response.data;
    });
};

const listenForNotifications = () => {
	Echo.private(`App.Models.User.${userId}`)
		.notification((notification) => {
			fetchNotificationCount();
			if (notification.message) {
				toast.info(notification.message);
			}
		});
};

onMounted(() => {
  fetchNotificationCount();
  listenForNotifications();
  fetchInboxCount();
})
</script>

<template>
	<div class="flex items-center px-8 py-2 text-3xl font-bold bg-slate-800">
		<img class="w-full h-20 object-cover cursor-pointer" :src="meoImg"
		alt="MEO" />
	</div>
	<nav class="flex-1 flex flex-col pt-1 px-2 m-0">
		<ul class="font-medium w-full">
			<li>
				<Link 
					:href="route('documentview')" 
					class="nav-link" 
					:class="{ 'bg-slate-800': isDocumentViewActive }">
						<i class="fas fa-computer w-5 h-5 text-center"></i> 
						<span class="ms-3">List of Requirements</span>
				</Link>
			</li>
			<li>
				<Link 
					:href="route('applicationform')" 
					class="nav-link" 
					:class="{ 'bg-slate-800': isApplicationFormActive}">
						<i class="fas fa-file-arrow-up  w-5 h-5 text-center"></i>
						<span class="ms-3">Application Form</span>
				</Link>
			</li>
			<li>
				<Link 
					:href="route('my-application-forms')" 
					class="nav-link" 
					:class="{ 'bg-slate-800': isSubmittedFormActive}">
						<i class="fas fa-file-arrow-up  w-5 h-5 text-center"></i>
						<span class="ms-3">Submitted Applications</span>
				</Link>
			</li>
			<li>
				<Link :href="route('inbox.index')" class="nav-link" :class="{ 'bg-slate-800': isInboxActive}">
					<i class="fas fa-envelope w-5 h-5 text-center"></i>
					<span class="ms-3">Inbox</span>
					<span v-if="InboxCount > 0" class="inline-flex items-center justify-center w-5 h-5 ml-auto text-xs font-semibold text-red-800 bg-red-200 rounded-full">
						{{ InboxCount }}
					</span>	
				</Link>
			</li>
			<li>
				<Link :href="route('notifications')" class="nav-link" :class="{ 'bg-slate-800': isNotificationActive}">
					<i class="fas fa-bell w-5 h-5 text-center"></i>
					<span class="ms-3">Notification</span>
					<span v-if="notificationCount > 0" class="inline-flex items-center justify-center w-5 h-5 ml-auto text-xs font-semibold text-red-800 bg-red-200 rounded-full">
						{{ notificationCount }}
					</span>
				</Link>
			</li>
		</ul>
	</nav>
	<div class="p-4 text-center">
			<Link 
				:href="route('logout')" 
				method="post" 
				as="button" 
				type="button" 
				class="w-full bg-red-500 text-white py-2 rounded hover:bg-red-600"
				>Logout
			</Link>
    </div>
</template>