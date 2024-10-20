<script setup>
import { ref, watch } from 'vue';

const props = defineProps({
    name: {
        type: String,
        required: true
    },
    options: {
        type: Array,
        required: true
    },
    modelValue: {
        type: [String, Number],
        required: true
    },
    message: {
        type: String
    },
    isVisible: {
        type: Boolean,
        default: true
    },
    details: {
        type: String,
    },
});

const emit = defineEmits(['update:modelValue', 'details']);

// Internal value to keep track of the selected option
const internalValue = ref(props.modelValue);
const tooltipVisible = ref(false);
const tooltipContent = ref('');

// Watch for changes to sync with the parent component
watch(internalValue, (newValue) => {
    emit('update:modelValue', newValue);
    const selectedOption = props.options.find(option => option.value === newValue);
    if (selectedOption) {
        emit('details', selectedOption.details);
        tooltipContent.value = newValue + " includes " + selectedOption.details;
    }
});

// Method to update the internal value when selection changes
function updateValue(event) {
    internalValue.value = event.target.value;
}
// Toggle tooltip visibility
function toggleTooltip() {
    tooltipVisible.value = !tooltipVisible.value;
}
</script>
<template>
    <div class="mb-3" :class="{'hidden' : !isVisible}">
        <!-- Tooltip -->
        <div v-if="tooltipVisible" class="absolute max-w-4xl mt-5 p-2 bg-white border rounded shadow-lg">
            {{ tooltipContent }}
        </div>
        <label class="block flex items-center">
            {{ name }}
            <span class="ml-2 text-blue-500 cursor-pointer" @click="toggleTooltip" title="Information">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M12 2c5.523 0 10 4.477 10 10s-4.477 10-10 10S2 17.523 2 12 6.477 2 12 2z"></path>
                </svg>
            </span>
        </label>
        <select :name="name" :value="internalValue" @change="updateValue"
            class="block w-full rounded-md border-0 p-2 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-500 focus:ring-2 focus:ring-inset focus:ring-blue-500 sm:text-sm bg-white">
            <option :value="option.value" v-for="option in options" :key="option.details">
                {{ option.label }}
            </option>
        </select>
        <small class="error" v-if="message">{{ message }}</small>
        
    </div>
</template>
<style scoped>
/* Optional: Positioning for the tooltip */
.tooltip {
    position: absolute;
    z-index: 10;
}
</style>