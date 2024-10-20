<script setup>
import ClientLayout from '../../Shared/ClientLayout.vue';
import RenewalRequirements from '../../Shared/RenewalRequirements.vue';
defineProps({
	requirements: [Object, Array],
});
defineOptions({ layout: ClientLayout });
</script>

<template>
    <RenewalRequirements :requirements="requirements"/>
    <div class="w-full max-w-4xl mx-auto px-4 card mb-3">
        <p class="text-slate-600  text-center">
            <a :href="route('renewalform')" class="primary-btn cursor-pointer">Apply</a>
        </p>
    </div>
</template>

<style scoped>
/* Style for numbered lists */
.list-decimal {
  list-style-type: decimal;
}

.list-lettered {
  list-style-type: lower-alpha; /* For lowercase letters (a, b, c, ...) */
}

.list-lettered > li {
  margin-bottom: 0.5rem; /* Add space between items if needed */
}
</style>
