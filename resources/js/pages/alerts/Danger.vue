<script setup lang="ts">
import Alert from '@/components/ui/alert/Alert.vue';
import AlertDescription from '@/components/ui/alert/AlertDescription.vue';
import AlertTitle from '@/components/ui/alert/AlertTitle.vue';
import { XCircle } from 'lucide-vue-next';
</script>

<template>
    <Alert class="fixed top-8 right-4 w-96 border-2 border-red-600">
        <XCircle class="h-5 w-5" color="red" />
        <AlertTitle class="text-red-600">Error</AlertTitle>
        <AlertDescription class="text-md text-red-600">
            <slot name="description" />
        </AlertDescription>
    </Alert>
</template>
