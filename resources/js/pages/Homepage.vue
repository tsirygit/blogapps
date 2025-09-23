<template>
    <NavbarLayout />

    <div class="mt-10 text-center lg:mt-15">
        <h1 class="mb-4 text-2xl font-bold text-balance text-teal-600 md:text-4xl lg:text-5xl">Bienvenue sur Notre Blog pour tout le monde.</h1>
        <p class="text-[15px] font-medium text-balance md:text-[20px] lg:text-[25px]">
            Découvrez des article passionnants rédigés par les autres. Partager Vos penseés, Vos problèmes et trouver des solution ainsi que pour
            interagissez avec les autres.
        </p>
    </div>
    <div class="mt-6 flex justify-center">
        <Link :href="route('post.create')" class="bg-teal-600 p-2 text-[15px] font-light text-white hover:bg-black lg:text-[20px]"
            >posté un nouveau publication</Link
        >
    </div>
    <div>
        <FlashMessage />
    </div>
    <div class="my-5 mt-15 px-20">
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
            <div v-for="post in posts" :key="post.id">
                <div class="max-w-sm rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                    <div class="flex justify-between">
                        <p v-if="post.user" class="text-sm text-gray-500 dark:text-gray-400">
                            Publié par <span class="font-semibold">{{ post.user.name }}</span>
                        </p>
                        <p v-else class="text-sm text-red-500">Auteur inconnu</p>

                        <Link
                            :href="route('post.show', post.id)"
                            class="inline-flex items-center rounded-lg bg-blue-700 px-3 py-2 text-center text-sm font-medium text-white hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 focus:outline-none dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        >
                            <svg
                                class="ms-2 h-3.5 w-3.5 rtl:rotate-180"
                                aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 14 10"
                            >
                                <path
                                    stroke="currentColor"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M1 5h12m0 0L9 1m4 4L9 9"
                                />
                            </svg>
                        </Link>
                    </div>

                    <a href="#">
                        <img class="rounded-t-lg" :src="getImageUrl(post.image)" alt="" />
                    </a>
                    <div class="p-5">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ post.title }}</h5>

                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ post.content }}</p>
                        <div class="flex justify-center gap-4">
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

                            <Link
                                :href="route('comment.create', post.id)"
                                class="inline-flex items-center rounded-lg bg-blue-700 px-3 py-2 text-center text-sm font-medium text-white hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 focus:outline-none dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <path
                                        fill="#fff"
                                        d="M6 14h12v-2H6zm0-3h12V9H6zm0-3h12V6H6zM4 18q-.825 0-1.412-.587T2 16V4q0-.825.588-1.412T4 2h16q.825 0 1.413.588T22 4v18l-4-4z"
                                    />
                                </svg>
                                <span class="ml-2 text-sm text-white">
                                    {{ post.comments_count }}
                                </span>
                            </Link>

                            <Link
                                :href="route('post.edit', post.id)"
                                class="inline-flex items-center rounded-lg bg-blue-700 px-3 py-2 text-center text-sm font-medium text-white hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 focus:outline-none dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 2048 2048">
                                    <path
                                        fill="currentColor"
                                        d="M256 1408V512h1536v232q-55 8-107 32t-91 63l-569 569zm641 128l-51 52l-19 76H0V256h2048v540q-29-19-61-31t-67-19V384H128v1152zm951-640q42 0 78 15t64 41t42 63t16 79q0 39-15 76t-43 65l-717 717l-377 94l94-377l717-716q29-29 65-43t76-14m51 249q21-21 21-51q0-31-20-50t-52-20q-14 0-27 4t-23 15l-692 692l-34 135l135-34z"
                                    />
                                </svg>
                            </Link>

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
import FlashMessage from '@/components/FlashMessage.vue';
import NavbarLayout from '@/layouts/NavbarLayout.vue';
import { Link, useForm } from '@inertiajs/vue3';
import { onMounted, reactive } from 'vue';

const props = defineProps({
    posts: Array,
});
const form = useForm({
    post_id: null,
    like: null,
});

const likedPosts = reactive({});

const getImageUrl = (Path) => {
    if (Path) {
        return `/storage/${Path}`;
    }
    return null;
};

const submit = (postId) => {
    form.delete(route('post.destroy', postId), {
        onSuccess: () => {
            showSuccess.value = true;
        },
    });
};

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
    props.posts.forEach((p) => {
        likedPosts[p.id] = p.isLiked;
    });
});
</script>
