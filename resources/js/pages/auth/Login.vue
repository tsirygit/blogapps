<template>
    <Head title="bienvenue au blog..." />
    <div class="flex min-h-screen items-center justify-center p-4">
    
        <div class="w-full max-w-sm rounded-lg bg-slate-900 p-8 shadow-lg">
            <h1 class="mb-4 text-center text-xl font-bold text-white md:text-2xl">Connecter à votre Compte</h1>
            <div class="my-4 mt-8 flex justify-center">
                <form @submit.prevent="submit" class="w-full">
                    <div v-for="(item, index) in inputs" :key="index.id" class="mb-3">
                        <Input
                            v-model="form[item.id]"
                            :id="item.id"
                            :label="item.label"
                            :type="item.type"
                            :placeholder="item.placeholder"
                            :rows="item.rows"
                            :error="form.errors[item.id]"
                        />
                    </div>

                    <ForgotPasswordLink />

                    <div class="mt-4 justify-items-center">
                        <div>
                            <button
                                type="submit"
                                :disabled="form.processing"
                                class="w-64 cursor-pointer bg-green-600 p-2 text-center font-bold text-white"
                            >
                                <span v-if="form.processing" class="flex animate-spin justify-center text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                        <g fill="white">
                                            <path
                                                fill-rule="evenodd"
                                                d="M12 19a7 7 0 1 0 0-14a7 7 0 0 0 0 14m0 3c5.523 0 10-4.477 10-10S17.523 2 12 2S2 6.477 2 12s4.477 10 10 10"
                                                clip-rule="evenodd"
                                                opacity="0.2"
                                            />
                                            <path d="M2 12C2 6.477 6.477 2 12 2v3a7 7 0 0 0-7 7z" />
                                        </g>
                                    </svg>
                                </span>
                                <span v-else>connectez</span>
                            </button>
                        </div>
                    </div>
                    <div class="mx-6 mt-4 text-center text-sm">
                        <p class="text-green-400">Vous n'avez pas du compte???</p>
                        <Link :href="route('register')" class="text-white hover:underline">creér un compte</Link>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script setup>
import Input from '@/composables/UI/Input.vue';
import ForgotPasswordLink from '@/composables/password/ForgotPasswordLink.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const inputs = ref([
    {
        id: 'email',
        label: 'Email',
        type: 'email',
        placeholder: 'Entrez votre address email...',
        rows: undefined,
        error: undefined,
    },
    {
        id: 'password',
        label: 'mot de passe',
        type: 'password',
        placeholder: 'Entrez votre mot de passe...',
        rows: undefined,
        error: undefined,
    },
]);
const form = useForm({
    email: '',
    password: '',
});

const submit = () => {
    form.post(route('login'), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
        },
    });
};
</script>
