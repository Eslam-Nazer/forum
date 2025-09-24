<script setup lang="ts">
defineProps<{
    message?: string;
}>();
</script>

<template>
    <div v-show="message" class="text-sm text-red-600 dark:text-red-500">
        <p>
            {{ message }}
        </p>
    </div>
</template>
