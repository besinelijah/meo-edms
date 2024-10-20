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
    isDisabled: {
        type: Boolean,
        default: true
    },
});
const emit = defineEmits(['update:modelValue']);

const internalValue = ref(props.modelValue);

watch(internalValue, (newValue) => {
    emit('update:modelValue', newValue);
});
</script>
<template>
    <div class="mb-3" :class="{'hidden' : !isVisible}">
      <label class="block">{{ name }}</label>
      <div class="grid grid-cols-2 gap-4 bg-gray-100 p-2">
        <label v-for="option in options" :key="option.value" class="flex items-center space-x-2">
          <input 
            type="radio" 
            :name="name" 
            :value="option.value"
            v-model="internalValue"
            :disabled="isDisabled"
            class="h-4 w-4 text-blue-600 ring-1 ring-slate-300 focus:ring-2 focus:ring-blue-500"
          >
          <span>{{ option.label }}</span>
        </label>
      </div>
      <small class="error" v-if="message">{{ message }}</small>
    </div>
  </template>
  