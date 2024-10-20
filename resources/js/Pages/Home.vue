<script setup>
import ClientLayout from '../Shared/ClientLayout.vue';
import { useForm } from "@inertiajs/inertia-vue3";

defineOptions({ layout: ClientLayout });

const form = useForm({
	type: null,
});

function loginAs(type) {
	form.type = type;
	form.get(route("login.index"));
}
</script>

<template>
	<Head title="Home" />

	<div class="relative w-full min-h-screen bg-cover bg-center bg-fixed bg-no-repeat"
		style="background-image: url('/storage/images/BG.png'); ">
		<div class="mx-auto max-w-8xl mt-8 mb-8 px-8">
			<div class="p-6 rounded-lg shadow-lg bg-cover bg-center mb-12"
				style="background-image: url('/storage/images/home_bg.png');">
				<div class="flex justify-between items-center mb-6">
					<img src="/storage/images/meo.png" alt="Logo" class="w-40 h-auto" />
				</div>

				<div class="flex justify-center items-center w-full h-full px-6">
					<div class="container mx-auto flex flex-col lg:flex-row gap-6 lg:gap-12">
						<div class="flex-1 p-6">
							<h2 class="text-3xl text-white font-bold mb-4">Welcome</h2>

							<p class="text-lg mb-6 text-white text-justify">
								MEO - Electronic Document Management System (EDMS) manages and supervises construction projects 
								to ensure they meet design specifications, safety standards, and regulatory requirements. 
								Issuing permits and approvals for private construction projects that affect public spaces 
								or utilities.
							</p>

							<div class="relative mb-8">
								<div class="flex items-center">
									<hr class="flex-1 border-t-2 border-gray-300" />
									<span class="mx-4 text-lg font-semibold text-white">Services</span>
									<hr class="flex-1 border-t-2 border-gray-300" />
								</div>

								<div class="flex justify-between mt-6">
									<div class="flex flex-col items-center">
										<div class="w-40 h-40 rounded-full bg-gray-200 flex items-center justify-center mb-2">
											<img src="/storage/images/BUSINESS.png" alt="Service 1" class="w-40 h-30" />
										</div>
										<p class="text-center text-white">Business Permit</p>
									</div>

									<div class="flex flex-col items-center">
										<div class="w-40 h-40 rounded-full bg-gray-200 flex items-center justify-center mb-2">
											<img src="/storage/images/BUILDING.png" alt="Service 2" class="w-40 h-30" />
										</div>
										<p class="text-center text-white">Building Permit</p>
									</div>

									<div class="flex flex-col items-center">
										<div class="w-40 h-40 rounded-full bg-gray-200 flex items-center justify-center mb-2">
											<img src="/storage/images/RENEW.png" alt="Service 3" class="w-40 h-30" />
										</div>
										<p class="text-center text-white">Business Permit Renewal</p>
									</div>
								</div>
							</div>
						</div>

						<div class="flex-1 bg-white p-6 rounded-lg shadow-lg mb-2 flex flex-col items-center justify-center">
							<h1 class="text-2xl font-semibold text-center mb-6">LOGIN AS</h1>
							<div class="flex flex-col gap-4 w-full max-w-md">
								<button class="w-full p-5 rounded-full bg-indigo-800 text-white"
									@click="loginAs(0)">User</button>
								<button class="w-full p-5 rounded-full bg-indigo-800 text-white"
									@click="loginAs(1)">Administrator</button>
							</div>
							<div class="text-center mt-6">
								<img src="/storage/images/buildings.png" alt="Additional Image" class="mx-auto w-60" />
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<style>
.bg-cover {
    background-size: cover;
}

.bg-center {
    background-position: center;
}

.bg-fixed {
    position: fixed;
}

.bg-no-repeat {
    background-repeat: no-repeat;
}
</style>
