<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import axios from 'axios';

// Initialize form
const form = useForm({
  subject: '',
  message: '',
  recepientsEmailAddress: '',
});

const isOtherEmail = true;

const submit = () => {
  // axios.post(route('admin.requests.send-email'), form) 
  //   .then((response) => {
  //     if (response.data.status == 'success') {
  //       toast.success(response.data.message);
  //     } else {
  //       toast.error(response.data.message);
  //     }
  //   });
  form.post(route('admin.requests.send-email'));
}
</script>
<template>
  <form @submit.prevent="submit" class="card !p-4 !w-3/4">
    <div class="mb-5">
      <label class="text-gray-900 text-sm font-medium block mb-2">Subject</label>
      <input
        v-model="form.subject"
        type="text"
        class="focus:ring-blue-500 focus:border-blue-500 block w-full"
        :class="{'!ring-red-500' : form.errors.subject}"
      />
      <small class="error" v-if="form.errors.subject">{{ form.errors.subject }}</small>
    </div>
    <div class="mb-5">
      <label class="text-gray-900 text-sm font-medium block mb-2">Message</label>
      <textarea
        v-model="form.message"
        rows="6"
        class="focus:ring-blue-500 focus:border-blue-500 block w-full"
        :class="{'!ring-red-500' : form.errors.message}"
      />
      <small class="error" v-if="form.errors.message">{{ form.errors.message }}</small>
    </div>
    <div class="mb-5">
      <label class="text-gray-900 text-sm font-medium block mb-2">Recepients</label>
      <input
        v-model="form.recepientsEmailAddress" 
        type="text"
        class="focus:ring-blue-500 focus:border-blue-500 block w-full"
        :class="{'!ring-red-500' : form.errors.recepientsEmailAddress}"
      />
      <small class="error" v-if="form.errors.recepientsEmailAddress">{{ form.errors.recepientsEmailAddress }}</small>
      <p class="text-xs text-gray-400 pl-2 pt-1">Multiple emails can be separated by commas (,) or semicolons (;)</p>
    </div>
    <hr class="border-t-2 border-gray-400 mt-6 mb-4" />
    <div class="mb-5">
      <label class="text-gray-900 text-sm font-medium block mb-2">Options</label>
      <div class="flex items-center mb-2 pl-4">
        <input type="radio" name="options" value="0" class="w-4 h-4 border-gray-300">
        <label for="country-option-1" class="block ms-2 text-sm font-normal text-gray-700">
          Include upload links for each document
        </label>
      </div>
      <div class="flex items-center pl-4">
        <input type="radio" name="options" value="1" class="w-4 h-4 border-gray-300">
        <label for="country-option-1" class="block ms-2 text-sm font-normal text-gray-700">
          Request to email the document to me
        </label>
      </div>
    </div>
    <div class="w-full grid justify-items-end">
      <div class="flex gap-2">
      <button
          class="text-white bg-blue-700 rounded-lg px-5 py-2.5 text-sm"
        >
          Send Request
        </button>
        <Link
          :href="route('admin.requests.index')"
          class="text-gray-900 border border-gray-700 rounded-lg px-5 py-2.5 text-sm"
        >
          Cancel
        </Link>
      </div>
    </div>
  </form>
</template>