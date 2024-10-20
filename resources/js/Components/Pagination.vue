<template>
    <nav v-if="pages.length" class="flex justify-center py-4">
        <ul class="flex space-x-3">
            <li :class="{ 'opacity-50 cursor-not-allowed': !hasPrevious }">
                <Link
                    :href="previousPageUrl"
                    class="px-4 py-2 border border-gray-300 bg-gray-100 rounded text-gray-700 hover:bg-gray-200"
                    :class="{ 'opacity-90 cursor-not-allowed': !hasPrevious }"
                    :disabled="!hasPrevious"
                    preserve-state
                    :method="method"
                    :data="params"
                    as="button"
                >
                    {{ "<" }} Previous
                </Link>
            </li>
            <li v-if="(currentPage-1) > 1">
                <Link
                    :href="getPageUrl(1)"
                    :method="method"
                    class="px-4 py-2 border border-gray-300 rounded text-gray-700 hover:bg-gray-100"
                    preserve-state
                    :data="params"
                    as="button"
                >
                1
                </Link>
            </li>
            <span v-if="(currentPage-1) > 1" class="py-5"> . . .</span>
            <li v-for="page in visiblePages" :key="page">
                <Link
                    :href="getPageUrl(page)"
                    :method="method"
                    class="px-4 py-2 border border-gray-300 rounded text-gray-700 hover:bg-gray-100"
                    :class="{ 'bg-blue-500 text-white': currentPage === page }"
                    preserve-state
                    :data="params"
                    as="button"
                >
                    {{ page }}
                </Link>
            </li>
            <span v-if="(currentPage + 1) < props.lastPage" class="py-5"> . . .</span>
            <li v-if="(currentPage + 1) < props.lastPage">
                <Link
                    :href="getPageUrl(props.lastPage)"
                    :method="method"
                    class="px-4 py-2 border border-gray-300 rounded text-gray-700 hover:bg-gray-100"
                    preserve-state
                    :data="params"
                    as="button"
                >
                    {{ props.lastPage }}
                </Link>
            </li>
            <li :class="{ 'opacity-50 cursor-not-allowed': !hasNext }">
                <Link
                    :href="nextPageUrl"
                    :method="method"
                    class="px-4 py-2 border border-gray-300 bg-gray-100 rounded text-gray-700 hover:bg-gray-200"
                    :class="{ 'opacity-90 cursor-not-allowed': !hasNext }"
                    :disabled="!hasNext"
                    preserve-state
                    :data="params"
                    as="button"
                >
                    Next {{ ">" }}
                </Link>
            </li>
        </ul>
    </nav>
</template>

<script setup>
import { computed, defineProps } from 'vue';

const props = defineProps({
    currentPage: {
        type: Number,
        required: true
    },
    lastPage: {
        type: Number,
        required: true
    },
    url: {
        type: String,
        required: true
    },
    previousPageUrl: {
        type: null,
        required: true
    },
    nextPageUrl: {
        type: null,
        required: true
    },
    params: {
        type: Object,
        default: {}
    },
    method: {
        type: String,
        default: 'get'
    }
});

const pages = computed(() => {
    const pagesArray = [];
    for (let i = 1; i <= props.lastPage; i++) {
        pagesArray.push(i);
    }
    return pagesArray;
});

const hasPrevious = computed(() => props.previousPageUrl !== null);
const hasNext = computed(() => props.nextPageUrl  !== null);

const visiblePages = computed(() => {
    const numberOfLinks = 3;
    const half = Math.floor(numberOfLinks / 2);

    let start = Math.max(1, props.currentPage - half);
    let end = Math.min(props.lastPage, props.currentPage + half);

    if (props.currentPage - half < 1) {
        end = Math.min(numberOfLinks, props.lastPage);
    }
    if (props.currentPage + half > props.lastPage) {
        start = Math.max(1, props.lastPage - numberOfLinks + 1);
    }

    return pages.value.slice(start - 1, end);
});


const getPageUrl = (page) => {
  return route(props.url, {page});
};
</script>
