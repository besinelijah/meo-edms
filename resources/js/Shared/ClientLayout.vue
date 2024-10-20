<script setup>
import { onMounted } from 'vue';
import Header from './Header.vue';
import SideNav from './ClientSideNav.vue';
import toast from "@/helper/toast.js";
import "@/helper/echo.js";

onMounted(toast.flash);
</script>
<template>
	<div class="flex h-screen">
	  <!-- Side Navigation -->
	 
	  <aside v-if="$page.props.auth.user" class="flex flex-col h-screen w-64 bg-sky-900 text-white">
		<SideNav />
	  </aside>
	  <!-- Main Content Area -->
	  <div class="flex-1 flex flex-col">
		<!-- Header -->
		<header class="bg-gray-600 text-white w-full" v-if="$page.props.auth.user">
		  <Header />
		</header>
		<!-- Main Content -->
		<main class="flex-1 overflow-y-auto h-[675px] bg-gray-100">
			<slot />
		</main>
	  </div>
	</div>
  </template>
