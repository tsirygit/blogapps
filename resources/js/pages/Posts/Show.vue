<template>
    <NavbarLayout />
    <div class="flex justify-center">
        <div class="mt-5 px-20 lg:mt-10">
            <div v-if="post">
                <div
                    class="flex flex-col items-center gap-10 rounded-lg border border-gray-200 bg-white p-4 shadow-sm hover:bg-gray-100 md:max-w-xl md:flex-row dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700"
                >
                    <img
                        class="h-96 w-full rounded-t-lg object-cover md:h-auto md:w-48 md:rounded-none md:rounded-s-lg"
                        :src="getImageUrl(post.image)"
                        alt=""
                    />
                    <div class="flex flex-col justify-between p-4 leading-normal">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ post.title }}</h5>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ post.content }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import NavbarLayout from '@/layouts/NavbarLayout.vue';
const props = defineProps({
    post: Object,
});

const getImageUrl = (Path) => {
    if (Path) {
        return `/storage/${Path}`;
    }
    return null;
};
</script>
