<script setup>
import { Link } from "@inertiajs/inertia-vue3";
import { ref, onMounted } from 'vue';

const currentDate = ref('');
const currentTime = ref('');
const props = defineProps({
	data: [Object, Array],
});

onMounted(() => {
	const updateDateTime = () => {
		const now = new Date();

		// Format date as 'Saturday, September 24, 2024'
		const dateFormatter = new Intl.DateTimeFormat('en-US', {
			weekday: 'long',
			month: 'long',
			day: 'numeric',
			year: 'numeric',
		});

		// Format time as '7:58 PM'
		const timeFormatter = new Intl.DateTimeFormat('en-US', {
			hour: 'numeric',
			minute: 'numeric',
			hour12: true,
		});

		currentDate.value = dateFormatter.format(now);
		currentTime.value = timeFormatter.format(now);
	};

	updateDateTime();
	setInterval(updateDateTime, 1000); // Update every second
	
});
</script>
<template>
	<header>
    <nav class="flex items-center w-full bg-gray-800 p-4">
        <!-- Home Link and Auth Links Container -->
        <div v-if="!$page.props.auth.user" class="flex w-full justify-between">
            <!-- Home Link on the Left -->
            <div class="flex items-center space-x-3">
                <!-- <Link :href="route('home')" class="nav-link"
                    :class="{ 'bg-slate-700': $page.component === 'Home' }">Home</Link> -->
            </div>
            <div class="flex items-center space-x-3">
                <div class="flex items-center space-x-3">
                    <Link :href="route('register')" class="nav-link"
                        :class="{ 'bg-slate-700': $page.component === 'Auth/Register' }">Register</Link>
                    <Link :href="route('login')" class="nav-link"
                        :class="{ 'bg-slate-700': $page.component === 'Auth/Login' }">Login {{$page.props.auth.user}}</Link>
                </div>
            </div>
        </div>
		<div v-else class="flex w-full justify-end">
			<div v-if="$page.props.auth.user" class="flex items-center space-x-6">
				<div class="flex flex-col items-end space-y-1 text-sm text-white">
					<span>Welcome, {{ $page.props.auth.user.username }}</span>
					<span>{{ currentDate }}</span>
					<span>{{ currentTime }}</span>
				</div>
			</div>
		</div>
    </nav>
</header>
</template>