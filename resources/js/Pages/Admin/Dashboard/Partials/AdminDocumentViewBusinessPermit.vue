<script setup>
import AuthenticatedLayout from '@/Admin/Layouts/AuthenticatedLayout.vue';
import BusinessPermitRequirements from '../../../../Shared/BusinessPermitRequirements.vue';
defineProps({
	requirements: [Object, Array],
});
defineOptions({ layout: AuthenticatedLayout });
</script>

<template>
    <BusinessPermitRequirements :requirements="requirements"/>
</template>