<template>
    <div class="mb-3">
        <label for="image" class="mb-2 block text-sm font-medium text-white">image: </label>
        <input
            type="file"
            @input="$emit('update:modelValue', $event.target.files[0])"
            class="rounded-md border-solid border-white bg-white p-2 outline-0 outline-offset-0 w-full"
        />
        <div v-if="error" class="text-red-500">{{ error }}</div>
    </div>
</template>

<script setup>

const props = defineProps({
    modelValue: File,
    error: String,
});

const emit = defineEmits(['update:modelValue']);
</script>
