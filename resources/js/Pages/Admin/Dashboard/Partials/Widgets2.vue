<script setup>
import AuthenticatedLayout from '../../../../Admin/Layouts/AuthenticatedLayout.vue';
defineOptions({ layout: AuthenticatedLayout });
const businessPermitImg = '/storage/images/busperm.png';
const bldgPermitImg = '/storage/images/bldgperm.png';
const renewalImg = '/storage/images/renewal.png';
</script>
<template>
	<div class="card mt-2">
		<h2 class="font-bold text-lg text-typography leading-tight mb-2">List of Requirements</h2>
		<div class="grid grid-cols-1 md:grid-cols-3 gap-3">
			<div class="overflow-hidden rounded-lg shadow-lg m-5 p-6 bg-sky-500 m-auto">
				<Link :href="route('admin.documentviewbusiness')" class="overflow-hidden rounded-lg shadow-lg">
				<img class="w-full h-50 object-cover bg-sky-500" :src="businessPermitImg" alt="Business Permit Image" />
				<p class="text-center text-white mt-2"> Business Permit</p>
				</Link>
			</div>
			<div class="overflow-hidden rounded-lg shadow-lg m-5 p-6 bg-blue-800 m-auto">
				<Link :href="route('admin.documentviewbldg')" class="overflow-hidden rounded-lg shadow-lg">
				<img class="w-full h-50 object-cover bg-blue-800" :src="bldgPermitImg" alt="Building Permit Image" />
				<p class="text-center text-white mt-2"> Building Permit</p>
				</Link>
			</div>
			<div class="overflow-hidden rounded-lg shadow-lg m-5 p-6 bg-red-800 m-auto">
				<Link :href="route('admin.documentviewrenewal')" class="overflow-hidden rounded-lg shadow-lg">
				<img class="w-full h-50 object-cover bg-red-800" :src="renewalImg"
					alt="Renewal Business Permit Image" />
				<p class="text-center text-white mt-2"> Business Permit Renewal</p>
				</Link>
			</div>
		</div>
	</div>
</template>