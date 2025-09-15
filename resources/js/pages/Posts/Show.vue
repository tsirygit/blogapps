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
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                            {{ post.title }}
                        </h5>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                            {{ post.content }}
                        </p>
                        <div class="flex flex-row justify-center gap-4">
                            <button
                                @click.prevent="like(post.id, true)"
                                :class="[
                                    'inline-flex items-center rounded-lg px-3 py-2 text-center text-sm font-medium text-white focus:ring-4 focus:outline-none',
                                    likedPosts[post.id] ? 'bg-red-600' : 'bg-blue-600 hover:bg-blue-700',
                                    'focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800',
                                ]"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <path
                                        fill="#fff"
                                        d="M23 10a2 2 0 0 0-2-2h-6.32l.96-4.57c.02-.1.03-.21.03-.32c0-.41-.17-.79-.44-1.06L14.17 1L7.59 7.58C7.22 7.95 7 8.45 7 9v10a2 2 0 0 0 2 2h9c.83 0 1.54-.5 1.84-1.22l3.02-7.05c.09-.23.14-.47.14-.73zM1 21h4V9H1z"
                                    />
                                </svg>
                                <span class="ml-2 text-sm text-white">
                                    {{ post.likes_count }}
                                </span>
                            </button>

                            <div
                                class="inline-flex items-center rounded-lg bg-blue-700 px-3 py-2 text-center text-sm font-medium text-white hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 focus:outline-none dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <path
                                        fill="#fff"
                                        d="M6 14h12v-2H6zm0-3h12V9H6zm0-3h12V6H6zM4 18q-.825 0-1.412-.587T2 16V4q0-.825.588-1.412T4 2h16q.825 0 1.413.588T22 4v18l-4-4z"
                                    />
                                </svg>
                            </div>
                            <button
                                @click.prevent="submit(post.id)"
                                class="inline-flex items-center rounded-lg bg-blue-600 px-3 py-2 text-center text-sm font-medium text-white hover:bg-red-600 focus:ring-4 focus:ring-blue-300 focus:outline-none dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <path
                                        fill="white"
                                        d="M7 21q-.825 0-1.412-.587T5 19V6H4V4h5V3h6v1h5v2h-1v13q0 .825-.587 1.413T17 21zm2-4h2V8H9zm4 0h2V8h-2z"
                                    />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import NavbarLayout from '@/layouts/NavbarLayout.vue';
import { useForm } from '@inertiajs/vue3';
import { onMounted, reactive } from 'vue';

const props = defineProps({
    post: Object,
});

const form = useForm({
    post_id: null,
    like: false,
});

const getImageUrl = (Path) => {
    return Path ? `/storage/${Path}` : null;
};

const likedPosts = reactive({});

const like = (postId, like) => {
    form.post_id = postId;
    form.like = like;

    form.post(route('likedislike'), {
        preserveScroll: true,
        onSuccess: () => {
            likedPosts[postId] = !likedPosts[postId];
        },
        onError: (errors) => {
            console.error('Erreur:', errors);
        },
    });
};

onMounted(() => {
    props.post.forEach((p) => {
        likedPosts[p.id] = p.isLiked;
    });
});

const submit = (postId) => {
    form.delete(route('post.destroy', postId));
};
</script>
