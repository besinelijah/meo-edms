<script setup>
import AuthenticatedLayout from '@/Admin/Layouts/AuthenticatedLayout.vue';
import BldgPermitRequirements from '../../../../Shared/BldgPermitRequirements.vue';
defineProps({
	requirements: [Object, Array],
});
defineOptions({ layout: AuthenticatedLayout });
</script>

<template>
    <BldgPermitRequirements :requirements="requirements"/>
</template>