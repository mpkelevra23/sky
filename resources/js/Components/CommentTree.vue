<script setup>
import { defineProps } from 'vue';

const props = defineProps({
    comments: {
        type: Array,
        default: () => []
    }
});
</script>

<template>
    <ul class="space-y-4">
        <li v-for="comment in comments" :key="comment.id" class="bg-white rounded-lg shadow p-4">
            <div class="mb-2">
                <div class="text-sm text-gray-500 mb-4 flex justify-between">
                    <span>{{ comment.profile.full_name }}</span>
                    <span>{{ comment.created_at }}</span>
                </div>
                <div class="text-gray-700">{{ comment.content }}</div>
            </div>
            <div class="pl-4">
                <comment-tree v-if="comment.children.length" :comments="comment.children"></comment-tree>
            </div>
        </li>
    </ul>
</template>

