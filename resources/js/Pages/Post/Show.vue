<script setup>
import {Link, usePage} from "@inertiajs/vue3";
import {ref, computed} from 'vue';
import CommentTree from '@/Components/CommentTree.vue';

// Получаем данные из контроллера с помощью хука usePage из библиотеки Inertia.js.
const {props} = usePage();

// Создаем реактивную переменную posts с помощью функции ref() из Vue 3, и инициализируем ее данными из контроллера
const post = ref(props.post);

// Функция для построения дерева комментариев
const buildCommentTree = (comments) => {
    const commentMap = {};
    comments.forEach(comment => {
        commentMap[comment.id] = {...comment, children: []};
    });

    const commentTree = [];
    comments.forEach(comment => {
        if (comment.parent_id) {
            if (commentMap[comment.parent_id]) {
                commentMap[comment.parent_id].children.push(commentMap[comment.id]);
            }
        } else {
            commentTree.push(commentMap[comment.id]);
        }
    });

    return commentTree;
};

// Создание вычисляемого свойства для дерева комментариев
const commentTree = computed(() => buildCommentTree(post.value.comments));
</script>

<template>
    <div class="w-1/2 mx-auto p-6">
        <div class="mb-4">
            <Link :href="route('posts.index')" class="flex items-center text-blue-500 hover:underline">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                          d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                          clip-rule="evenodd"/>
                </svg>
                Back to Posts
            </Link>
        </div>

        <article class="p-6 bg-white rounded-md shadow-md">
            <h1 class="text-3xl font-bold mb-4">{{ post.title }}</h1>
            <div class="text-sm text-gray-500 mb-4 flex justify-between">
                <span>{{ post.profile.full_name }}</span>
                <span>{{ post.created_at }}</span>
            </div>
            <img :src="post.image" :alt="post.title" class="w-full h-auto mb-4 rounded-md">
            <div class="prose max-w-none">
                {{ post.content }}
            </div>

            <div v-if="post.comments && post.comments.length > 0" class="mt-8">
                <h2 class="text-2xl font-bold mb-4">Comments</h2>
                <comment-tree :comments="commentTree"></comment-tree>
            </div>
            <div v-else>
                <p class="text-gray-500 mt-4">No comments yet.</p>
            </div>
        </article>
    </div>
</template>

<style scoped>
</style>
