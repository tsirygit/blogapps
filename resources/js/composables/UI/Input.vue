<template>
    <div class="relative z-10">
        <label :for="id" class="mb-2 block text-sm font-medium text-white">
            {{ label }}
        </label>

        <component
            :is="type === 'textarea' ? 'textarea' : 'input'"
            :id="id"
            :rows="type === 'textarea' ? rows : undefined"
            :placeholder="placeholder"
            :type="type !== 'textarea' ? type : undefined"
            :value="modelValue"
            @input="$emit('update:modelValue', $event.target.value)"
            class="w-full rounded-md border-solid border-white bg-white border-2 p-2 outline-0 outline-offset-0"
        >
        </component>

        <div v-if="error" class="mt-1 text-start text-lg text-red-500">
            {{ Array.isArray(error) ? error[0] : error }}
        </div>
    </div>
</template>

<script setup>
defineProps({
    id: { type: String, required: true },
    label: { type: String, required: true },
    type: { type: String, required: true },
    placeholder: { type: String, default: '' },
    rows: { type: Number, default: 4 },
    modelValue: [String, Number],
    error: [String, Array],
});

defineEmits(['update:modelValue']);
</script>
