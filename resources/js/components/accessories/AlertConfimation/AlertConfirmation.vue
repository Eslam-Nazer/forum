<script setup lang="ts">

import {
    AlertDialog, AlertDialogAction, AlertDialogCancel,
    AlertDialogContent, AlertDialogDescription, AlertDialogFooter,
    AlertDialogHeader,
    AlertDialogTitle,
    AlertDialogTrigger
} from '@/components/ui/alert-dialog';
import { Button } from '@/components/ui/button';

const props = withDefaults(defineProps<{
    variant?: 'default' | 'destructive' | 'outline' | 'secondary' | 'ghost' | 'link' | null | undefined;
    actionButton: string;
    title: string;
    description?: string;
    cancel?: string;
    continueText?: string;
    continueVariant?: 'default' | 'destructive';
}>(), {
    variant: 'default',
    description: 'This action cannot be undone. This will permanently delete your\n ' +
        'account and remove your data from our servers.',
    cancel: 'Cancel',
    continueText: 'Continue',
    continueVariant: 'default'
});

const emit = defineEmits<{
    (event: 'confirm'): void
}>();
</script>

<template>
    <AlertDialog>
        <AlertDialogTrigger asChild>
            <Button :variant="variant" class="cursor-pointer">
                {{ actionButton }}
            </Button>
        </AlertDialogTrigger>
        <AlertDialogContent>
            <AlertDialogHeader>
                <AlertDialogTitle>{{ title }}</AlertDialogTitle>
                <AlertDialogDescription>{{ description }}</AlertDialogDescription>
            </AlertDialogHeader>
            <AlertDialogFooter>
                <AlertDialogAction
                    @click="emit('confirm')"
                    class="cursor-pointer"
                    :class="{
                        'dark:bg-red-900 dark:text-white hover:bg-red-700': continueVariant === 'destructive'
                    }"
                >
                    {{ continueText }}
                </AlertDialogAction>
                <AlertDialogCancel class="cursor-pointer">{{ cancel }}</AlertDialogCancel>
            </AlertDialogFooter>
        </AlertDialogContent>
    </AlertDialog>
</template>

<style scoped>

</style>
