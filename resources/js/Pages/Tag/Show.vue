<script setup>
import {Link, usePage} from "@inertiajs/vue3";
import {ref} from 'vue';

const {props} = usePage();

const tag = ref(props.tag);
</script>

<template>
    <div class="w-1/2 mx-auto p-6">
        <div class="mb-4">
            <Link :href="route('categories.index')" class="flex items-center text-blue-500 hover:underline">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                          d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                          clip-rule="evenodd"/>
                </svg>
                Back to Tags
            </Link>
        </div>

        <div class="p-6 bg-white rounded-md shadow-md">
            <h1 class="text-3xl font-bold mb-4">{{ tag.name }}</h1>
            <p class="text-gray-500 mb-4">Created at: {{ tag.created_at }}</p>
        </div>
    </div>
</template>

<style scoped>
</style>
