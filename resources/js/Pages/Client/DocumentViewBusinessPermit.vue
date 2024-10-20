<script setup>
import ClientLayout from '../../Shared/ClientLayout.vue';
import BusinessPermitRequirements from '../../Shared/BusinessPermitRequirements.vue';
defineProps({
	requirements: [Object, Array],
});
defineOptions({ layout: ClientLayout });
</script>

<template>
    <BusinessPermitRequirements :requirements="requirements"/>
    <div class="w-full max-w-4xl mx-auto px-4 card mb-3">
        <p class="text-slate-600  text-center">
            <a :href="route('businesspermitform')" class="primary-btn cursor-pointer">Apply</a>
        </p>
    </div>
</template>