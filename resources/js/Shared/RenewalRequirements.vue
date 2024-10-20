<script setup>
import { ref } from 'vue';

defineProps({
    requirements: [Object, Array],
});

var currentCategory = '';
var currentSubCategory = '';
function isCurrentCategory(category, index) {
    if (currentCategory != category || index == 0) {
        currentCategory = category;

        return true;
    }

    return false;
}
function isCurrentSubCategory(subcategory, index) {
    if (currentSubCategory != subcategory || index == 0) {
        currentSubCategory = subcategory;

        return true;
    }

    return false;
}
</script>
<template>
    <div class="w-full max-w-4xl mx-auto px-4 py-6 card mt-3">

        <Head title="Document View Business Permit" />
        <div v-for="(item, index) in requirements" :key="index">
            <h1 class="text-2xl font-bold mb-2 text-center" v-if="isCurrentCategory(item.category_name, index)">{{ item.category_name }}</h1>
            <h2 class="text-xl font-semibold mb-4" v-if="isCurrentSubCategory(item.subcategory_name, index)">{{ item.subcategory_name }}</h2>
            <li class="ml-5">
                {{ item.requirements_name }}
            </li>
        </div>
    </div>
</template>
<style scoped>
.list-decimal {
    list-style-type: decimal;
}

.list-lettered {
    list-style-type: lower-alpha;
}

.list-lettered>li {
    margin-bottom: 0.5rem;
}
</style>