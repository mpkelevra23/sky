<script setup>
import {Link} from "@inertiajs/vue3";
</script>

<template>
    <div class="min-h-screen bg-gray-100 flex flex-col items-center justify-center">
        <h1 class="text-4xl font-bold mb-6">Main Index</h1>
        <p class="text-lg mb-4">This is the main page of the site with links to other pages.</p>
        <nav class="bg-white shadow rounded-lg p-4">
            <!-- Метод route() из пакета ziggy-js позволяет создавать ссылки на именованные маршруты Laravel. -->
            <ul class="flex space-x-4">
                <Link :href="route('posts.index')">
                    <li class="text-blue-500 hover:text-blue-700">
                        Posts
                    </li>
                </Link>
                <Link :href="route('profiles.index')">
                    <li class="text-blue-500 hover:text-blue-700">
                        Profiles
                    </li>
                </Link>
                <Link :href="route('categories.index')">
                    <li class="text-blue-500 hover:text-blue-700">
                        Categories
                    </li>
                </Link>
                <Link :href="route('tags.index')">
                    <li class="text-blue-500 hover:text-blue-700">
                        Tags
                    </li>
                </Link>
                <Link :href="route('comments.index')">
                    <li class="text-blue-500 hover:text-blue-700">
                        Comments
                    </li>
                </Link>
            </ul>
        </nav>
    </div>
</template>

<style scoped>
</style>
