<template>
    <Head title="nouveau mot de passe" />
    <div class="flex min-h-screen items-center justify-center">
        <div class="w-full max-w-sm rounded-lg bg-slate-900 p-8 shadow-lg">
            <h1 class="mb-2 text-center text-xl font-bold text-white md:text-2xl">resilé votre mot de passe</h1>
            <div class="mt-8 flex justify-center">
                <form @submit.prevent="submit" class="w-full">
                    <div v-for="(item, index) in inputs" :key="index.id">
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
                    <div class="mt-4 flex justify-between">
                        <div>
                            <button
                                type="submit"
                                :disabled="form.processing"
                                class="w-32 cursor-pointer bg-green-600 p-2 text-center font-bold text-white"
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
                                <span v-else>New Password</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script setup>
import Input from '@/composables/UI/Input.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const inputs = ref([
    {
        id: 'email',
        label: 'email:',
        type: 'email',
        placeholder: 'Entrez votre address email....',
        rows: undefined,
        error: undefined,
    },
    {
        id: 'password',
        label: 'mot de passe:',
        type: 'password',
        placeholder: 'Entrez votre nouveau mot de passe....',
        rows: undefined,
        error: undefined,
    },
    {
        id: 'password_confirmation',
        label: 'mot de passe confirmation:',
        type: 'password',
        placeholder: 'confirmez votre nouveau mot de passe....',
        rows: undefined,
        error: undefined,
    },
]);

const props = defineProps({
    email: String,
    token: String,
});

const form = useForm({
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('password.store'), {
        onFinish: () => {
            form.reset('password', 'confirmez votre mot de passe');
        },
    });
};
</script>
