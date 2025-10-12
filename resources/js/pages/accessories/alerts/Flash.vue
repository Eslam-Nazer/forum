<script setup lang="ts">
import Alert from '@/components/ui/alert/Alert.vue';
import AlertDescription from '@/components/ui/alert/AlertDescription.vue';
import AlertTitle from '@/components/ui/alert/AlertTitle.vue';
import { Rocket } from 'lucide-vue-next';
</script>

<template>
    <Alert class="fixed top-8 right-4 w-96 border-2 border-green-600">
        <Rocket class="h-5 w-5" color="green" />
        <AlertTitle class="text-green-600">Success</AlertTitle>
        <AlertDescription class="text-md text-green-600">
            <slot name="description" />
        </AlertDescription>
    </Alert>
</template>
