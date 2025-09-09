<template>
    <div class="w-full max-w-sm rounded-lg bg-slate-900 p-8 shadow-lg">
        <h3 class="text-start text-xl font-bold text-white">supprimez votre compte</h3>
        <p class="font-normal text-white">vous-etez sur que vous supprimez votre compte??</p>

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
                <div v-if="form.errors.message" class="mt-1 text-center text-lg text-red-500">
                    {{ form.errors.message }}
                </div>

                <div class="mt-4 flex justify-between gap-4">
                    <Link :href="route('profile.edit')" class="w-36 cursor-pointer bg-gray-600 p-2 text-center font-bold text-white"> annuler </Link>

                    <button type="submit" :disabled="form.processing" class="w-48 cursor-pointer bg-red-600 p-2 text-center font-bold text-white">
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
                        <span v-else>supprimez</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
import Input from '@/composables/UI/Input.vue';
import { Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const inputs = ref([
    {
        id: 'password',
        label: 'votre mot de passe actuel',
        type: 'password',
        placeholder: 'Entrez votre mot de passe actuel...',
        rows: undefined,
        error: undefined,
    },
]);

const props = defineProps({
    errors: Object,
});

const form = useForm({
    password: '',
});

const submit = () => {
    form.delete(route('profile.destroy'), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
        },
    });
};
</script>
