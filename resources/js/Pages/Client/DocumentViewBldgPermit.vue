<script setup>
import ClientLayout from '../../Shared/ClientLayout.vue';
import BldgPermitRequirements from '../../Shared/BldgPermitRequirements.vue';
defineOptions({ layout: ClientLayout });
defineProps({
	requirements: [Object, Array],
});
</script>

<template>
    <BldgPermitRequirements :requirements="requirements"/>
    <div class="w-full max-w-4xl mx-auto px-4 card mb-3">
        <p class="text-slate-600  text-center">
            <a :href="route('buildingpermitform')" class="primary-btn cursor-pointer">Apply</a>
        </p>
    </div>
</template>