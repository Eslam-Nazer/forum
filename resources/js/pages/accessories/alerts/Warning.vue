<script setup lang="ts">
import Alert from '@/components/ui/alert/Alert.vue';
import AlertDescription from '@/components/ui/alert/AlertDescription.vue';
import AlertTitle from '@/components/ui/alert/AlertTitle.vue';
import { AlertTriangle } from 'lucide-vue-next';
</script>

<template>
    <Alert class="fixed top-8 right-4 w-96 border-2 border-yellow-400">
        <AlertTriangle class="h-5 w-5" color="yellow" />
        <AlertTitle class="text-yellow-400">Warning</AlertTitle>
        <AlertDescription class="text-md text-yellow-400">
            <slot name="description" />
        </AlertDescription>
    </Alert>
</template>
