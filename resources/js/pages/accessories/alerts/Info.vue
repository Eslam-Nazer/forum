<script setup lang="ts">
import Alert from '@/components/ui/alert/Alert.vue';
import AlertDescription from '@/components/ui/alert/AlertDescription.vue';
import AlertTitle from '@/components/ui/alert/AlertTitle.vue';
import { AlertCircle } from 'lucide-vue-next';
</script>

<template>
    <Alert class="fixed top-8 right-4 w-96 border-2 border-blue-600">
        <AlertCircle class="h-5 w-5" color="blue" />
        <AlertTitle class="text-blue-600">Information</AlertTitle>
        <AlertDescription class="text-md text-blue-600">
            <slot name="description" />
        </AlertDescription>
    </Alert>
</template>
