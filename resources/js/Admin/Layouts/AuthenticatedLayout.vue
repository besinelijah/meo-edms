<script setup>
import Header from "@/Shared/Header.vue";
import Sidebar from "@/Admin/Components/Sidebar.vue";
import toast from "@/helper/toast.js";
import { onMounted } from 'vue';

onMounted(toast.flash);
</script>

<template>
	<div class="flex h-screen">
    <aside class="flex flex-col h-screen w-64 bg-sky-900 text-white fixed top-0">
      <Sidebar />
    </aside>
    <!-- Main Content Area -->
	  <div class="flex-1 flex flex-col">
      <!-- Header -->
		  <header class="bg-gray-600 text-white w-full">
        <Header />
      </header>
      <!-- Main Content -->
		  <main class="p-4 bg-gray-100 h-[675px] ml-64">
        <slot />
      </main>
    </div>
  </div>
</template>