<script setup>
import AuthenticatedLayout from '@/Admin/Layouts/AuthenticatedLayout.vue';
import RenewalRequirements from '../../../../Shared/RenewalRequirements.vue';
defineProps({
	requirements: [Object, Array],
});
defineOptions({ layout: AuthenticatedLayout });
</script>

<template>
    <RenewalRequirements :requirements="requirements"/>
</template>