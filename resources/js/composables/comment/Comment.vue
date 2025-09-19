<template>
<div class="px-10">
    <h3 class="text-xl font-bold text-gray-800">Commentaires du post:</h3>
    <div class="mt-10 space-y-4">
        <div v-if="post.comments.length" class="flex justify-start gap-6">
            <div v-for="comment in post.comments" :key="comment.id" class="rounded-md border bg-white p-2 shadow">
                <span class="font-semibold text-gray-800">{{ comment.user.name }}:</span>
                <p class="text-sm text-gray-700">{{ comment.content }}</p>
            </div>
        </div>
        <div v-else class="text-sm text-gray-400">Aucun commentaire pour ce post.</div>
    </div>
</div>
</template>

<script setup>
const props = defineProps({
    post: Object,
});
</script>
