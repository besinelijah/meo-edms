<script setup>
import AuthenticatedLayout from '@/Admin/Layouts/AuthenticatedLayout.vue';
import Chat from '@/Components/Chat.vue';
import { ref, computed, onMounted } from 'vue';

const isSearching = ref(false);
const filterText = ref('');
const props = defineProps({
  data: [Object, Array]
});

const handleSearching = (isFocus) => {
  isSearching.value = isFocus;
};

const filteredUsers =  computed(() => {
  const filter = filterText.value ? filterText.value.toLowerCase() : '';
  return props.data.users.filter(user => {
    const fullName = `${user.client.fname.toLowerCase()} ${user.client.lname.toLowerCase()}`;
    return fullName.includes(filter);
  });
})

const addUser = (newUser) => {
  if (newUser.id !== props.data.currentUser.id) {
    const userExists = props.data.chatMates.some(user => user.id === newUser.id);

    if (!userExists) {
      props.data.chatMates.unshift(newUser);
    }
  }
};

onMounted(() => {
  addUser(props.data.friend);
});
defineOptions({layout: AuthenticatedLayout});
</script>

<template>
  <Head title="Approval Queue" />
  <div class="grid grid-cols-4 gap-4">
    <div class="card h-[80vh] !px-2 !m-0 !py-6">
      <div class="flex flex-column items-center mb-2">
        <span v-if="isSearching" class="h-100 fas fa-arrow-left pr-2" @click="handleSearching(false)"></span>
        <input
          type="search"
          v-model="filterText"
          class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
          placeholder="Search User"
          @focus="handleSearching(true)"
          @keypress="filterUser"
        />
      </div>
      <a 
        v-if="isSearching"
        :href="route('inbox.chat', user.id)"
        class="px-4 py-2 block"
        v-for="user in filteredUsers"
      >
        {{ user.client.fname }} {{ user.client.lname }}
      </a>
      <a 
        v-else
        :href="route('inbox.chat', user.id)"
        :class="{'bg-blue-500 rounded-lg text-white': user.id === props.data.friend.id}"
        class="px-4 py-2 block"
        v-for="user in props.data.chatMates"
      >
        {{ user.client.fname }} {{ user.client.lname }}
      </a>
    </div>
    <div class="card col-span-3 !p-0">
      <Chat :data="props.data"/>
    </div>
  </div>  
</template>