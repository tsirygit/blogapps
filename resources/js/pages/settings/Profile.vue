<template>
    <Head title="Profile..." />
    <NavbarLayout />

    <div class="flex min-h-screen items-center justify-center p-4">
        <div class="grid grid-cols-1 gap-y-4 lg:grid-cols-2 lg:gap-6">
            <div class="w-full max-w-sm rounded-lg bg-slate-900 p-8 shadow-lg">
                <div class="text-white">
                    <h3 class="text-start text-xl font-bold">méttre à jour votre profile</h3>
                    <p class="font-normal">mettre a jour votre nom et votre email</p>
                </div>

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
                        <div class="mt-4">
                            <div>
                                <button
                                    type="submit"
                                    :disabled="form.processing"
                                    class="w-full cursor-pointer bg-green-600 p-2 text-center font-bold text-white"
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
                                    <span v-else>méttre à jour</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div>
                <DeleteAccount />
            </div>
        </div>
    </div>
</template>

<script setup>
import DeleteAccount from '@/composables/settings/DeleteAccount.vue';
import Input from '@/composables/UI/Input.vue';
import NavbarLayout from '@/layouts/NavbarLayout.vue';
import { Head, useForm, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';

const inputs = ref([
    {
        id: 'name',
        label: 'nom',
        type: 'text',
        placeholder: 'entrez votre nom...',
        rows: undefined,
        error: undefined,
    },

    {
        id: 'email',
        label: 'email',
        type: 'email',
        placeholder: 'Enter votre address email...',
        rows: undefined,
        error: undefined,
    },
]);

const props = defineProps({
    name: String,
    email: String,
});
const page = usePage();

const user = page.props.auth.user;

const form = useForm({
    name: user.name,
    email: user.email,
});

const submit = () => {
    form.patch(route('profile.update'), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
        },
    });
};
</script>
