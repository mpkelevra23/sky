<script setup>
import {Link, usePage} from "@inertiajs/vue3";
import {ref} from 'vue';

const {props} = usePage();

const categories = ref(props.categories);
</script>

<template>
    <div class="w-1/2 mx-auto p-6">
        <div class="mb-4">
            <Link :href="route('main.index')" class="flex items-center text-blue-500 hover:underline">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                          d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                          clip-rule="evenodd"/>
                </svg>
                Back to Main Page
            </Link>
        </div>
        <h1 class="text-2xl font-bold mb-4">Categories List</h1>
        <ul class="space-y-4">
            <li
                v-for="category in categories"
                :key="category.id"
                class="p-4 bg-white rounded-md shadow-md hover:bg-gray-100 hover:shadow-lg transition duration-200"
            >
                <Link :href="route('categories.show', category.id)" class="block">
                    <h2 class="text-xl font-bold mb-2">{{ category.name }}</h2>
                    <p class="text-gray-600 line-clamp-3">
                        {{ category.description }}
                    </p>
                </Link>
            </li>
        </ul>
    </div>
</template>

<style scoped>

</style>
