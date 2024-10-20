<script setup>
defineProps({
	requirements: [Object, Array],
});
var currentCategory = '';
var currentSubCategory = '';
var categoryIndex = 0;
var subCategoryIndex = 0;
function isCurrentCategory(category, index) {
    if (currentCategory != category || index == 0) {
        currentCategory = category;
        categoryIndex++;
        subCategoryIndex = 0;
        return true;
    }
    return false;
}
function isCurrentSubCategory(subcategory, index) {
    if (currentSubCategory != subcategory || index == 0) {
        currentSubCategory = subcategory;
        subCategoryIndex++;

        return true;
    }

    return false;
}
</script>
<template>
    <div class="w-full max-w-4xl mx-auto px-4 py-6 card mt-3">
        
        <Head title="Document View Business Permit" />
        <h1 class="text-2xl font-bold mb-2 text-center">Requirements of Application for Building Permit</h1>
        <hr class="border-gray-300 mb-6" />
        <div v-for="(item, index) in requirements" :key="index" class="mb-2">
            <h2 class="text-xl font-bold mb-2 text-left mt-2" v-if="isCurrentCategory(item.category_name, index)">{{categoryIndex}}. {{ item.category_name }}</h2>
            <h4 class="text-md font-semibold" style="padding-left: 30px;"  v-if="isCurrentSubCategory(item.subcategory_name, index)">{{subCategoryIndex}}. {{ item.subcategory_name }}</h4>
            <li class="ml-5" style="padding-left: 60px;" >{{ item.requirements_name }}</li>
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