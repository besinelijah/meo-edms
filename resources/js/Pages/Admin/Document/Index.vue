<script setup>
import { ref, computed } from "vue";
import AuthenticatedLayout from '@/Admin/Layouts/AuthenticatedLayout.vue';
import RequirementTab from './Partials/RequirementTab.vue';
import FeeTab from './Partials/FeeTab.vue';
import CategoryTab from "./Partials/CategoryTab.vue";
import SubcategoryTab from "./Partials/SubcategoryTab.vue";

defineProps({
	categories: [Object, Array],
	subcategories: [Object, Array],
	requirements: [Object, Array],
});

const activeTab = ref("category");

function changeTab(tab) {
  activeTab.value = tab;
}

const activeTabComponent = computed(() => {
  switch (activeTab.value) {
    case 'requirement':
      return RequirementTab;
    // case 'fee':
    //   return FeeTab;
    case 'category':
      return CategoryTab;
    case 'subcategory':
      return SubcategoryTab;
    default:
      return null;
  }
});
const modal = (data)=>{

}
defineOptions({layout: AuthenticatedLayout});
</script>

<template>
  <Head title="Documents" />
    <div class="px-6">
      <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-center">Requirements Library</h1>
      </div>
      <div class="card !p-2 mt-2">
        <ul class="flex flex-wrap border-b-2 border-gray-200">
          <li>
            <Button
              @click="changeTab('category')"
              :class="{'bg-gray-600 text-white hover:bg-gray-600': activeTab === 'category'}"
              class="min-w-[120px] text-center inline-block py-2 px-4 rounded-none hover:bg-gray-200"
            >
              Categories
            </Button>
          </li>
          <li>
            <Button
              @click="changeTab('subcategory')"
              :class="{'bg-gray-600 text-white hover:bg-gray-600': activeTab === 'subcategory'}"
              class="min-w-[120px] text-center inline-block py-2 px-4 rounded-none hover:bg-gray-200"
            >
              Sub-Categories
            </Button>
          </li>
          <li>
            <Button
              @click="changeTab('requirement')"
              :class="{'bg-gray-600 text-white hover:bg-gray-600': activeTab === 'requirement'}"
              class="min-w-[120px] text-center inline-block py-2 px-4 rounded-none hover:bg-gray-200"
            >
              Requirements
            </Button>
          </li>
         

         
        </ul>
        <div class="p-2">
          <component :is="activeTabComponent" 
            :categories="categories"
            :active="activeTab"
            :subcategories="subcategories"
            :requirements="requirements"
          />
        </div>
      </div>
    </div>
</template>