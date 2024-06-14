<script setup>
import {Link, usePage} from "@inertiajs/vue3";
import {ref} from 'vue';

const {props} = usePage();

const comment = ref(props.comment);
</script>

<!--TODO добавить просмотр дочерних комментариев-->
<template>
    <div class="w-1/2 mx-auto p-6">
        <div class="mb-4">
            <Link :href="route('comments.index')" class="flex items-center text-blue-500 hover:underline">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                          d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                          clip-rule="evenodd"/>
                </svg>
                Back to Comments
            </Link>
        </div>

        <article class="p-6 bg-white rounded-md shadow-md">
            <h1 class="text-3xl font-bold mb-4">{{ comment.title }}</h1>
            <div class="text-sm text-gray-500 mb-4 flex justify-between">
                <span>{{ comment.profile.full_name }}</span>
                <span>{{ comment.created_at }}</span>
            </div>
            <div class="prose max-w-none">
                {{ comment.content }}
            </div>
        </article>
    </div>
</template>

<style scoped>
</style>
