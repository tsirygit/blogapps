<template>
    <div v-if="successMessage && showSuccess" class="mx-auto my-4 max-w-xl rounded bg-green-100 p-4 text-center text-green-800 shadow">
        {{ successMessage }}
    </div>
</template>

<script setup>
import { usePage } from '@inertiajs/vue3';
import { computed, onMounted, ref } from 'vue';
const page = usePage();

const successMessage = computed(() => page.props.flash?.success);

const showSuccess = ref(true);

onMounted(() => {
    setTimeout(() => {
        showSuccess.value = false;
    }, 3000);
});
</script>
