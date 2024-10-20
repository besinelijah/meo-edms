<script setup>
import { nextTick, onMounted, ref, watch } from "vue";
import { useForm } from '@inertiajs/inertia-vue3';
import axios from 'axios';
import ClientLayout from "@/Shared/ClientLayout.vue";

const props = defineProps({
	data: [Object, Array],
});
const isFriendTyping = ref(false);
const isFriendTypingTimer = ref(null);
const messagesContainer = ref(null);

// Initialize form
const form = useForm({
  message: '',
  receiver_id: props.data.friend.id,
  sender_id: props.data.currentUser.id
});

defineOptions({layout: ClientLayout});

const submit = async () => {
  axios.post(route('chat.send'), form)
    .then((response) => {
      props.data.messages.push(response.data.chat);
      form.message = '';
    });
}

const sendTypingEvent = () => {
  Echo.private(`chat.${props.data.friend.id}`).whisper("typing", {
    userID: props.data.currentUser.id,
  });
};

watch(
  props.data.messages,
  () => {
    nextTick(() => {
      messagesContainer.value.scrollTo({
        top: messagesContainer.value.scrollHeight,
        behavior: "smooth",
      });
    });
  },
  { deep: true }
);

onMounted(() => {
  Echo.private(`chat.${props.data.currentUser.id}`)
    .listen("MessageSentEvent", (response) => {
      props.data.messages.push(response.message);
    })
    .listenForWhisper("typing", (response) => {
      isFriendTyping.value = response.userID === props.data.friend.id;

      if (isFriendTypingTimer.value) {
        clearTimeout(isFriendTypingTimer.value);
      }

      isFriendTypingTimer.value = setTimeout(() => {
        isFriendTyping.value = false;
      }, 1000);
    });
});
</script>

<template>
  <div class="max-h-[100%]">
    <template v-if="data.friend.id !== data.currentUser.id">
      <div class="flex flex-col justify-end  max-h-[68vh] h-[68vh] pt-4">
        <div ref="messagesContainer" class="p-4 overflow-y-auto grid gap-4">
          <template
            v-for="message in data.messages"
            :key="message.id"
            class="flex items-center mb-2"
          >
            <div
              v-if="message.sender_id === data.currentUser.id"
              class="p-2 ml-auto text-white bg-blue-500 rounded-lg"
            >
              <span>{{ message.message }}</span>
            </div>
            <div
              v-if="message.sender_id === data.friend.id"
              class="p-2 mr-auto bg-gray-200 rounded-lg d-block"
            >
              <span>{{ message.message }} </span>
            </div>
          </template>
        </div>
      </div>
      <div class="flex items-center p-4 pb-0">
        <input
          type="text"
          v-model="form.message"
          @keydown="sendTypingEvent"
          @keyup.enter="submit"
          placeholder="Type a message..."
          class="flex-1 px-2 py-1 border rounded-lg"
        />
        <button
          @click="submit"
          class="px-4 py-1 ml-2 text-white bg-blue-500 rounded-lg"
        >
          Send
        </button>
      </div>
      <small v-if="isFriendTyping"  class="text-gray-700 pl-6">
        {{ data.friend.client.fname }} is typing...
      </small>
    </template>
  </div>
</template>