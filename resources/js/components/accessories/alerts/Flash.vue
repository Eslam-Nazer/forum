<script setup lang="ts">
import Alert from '../../ui/alert/Alert.vue';
import AlertDescription from '../../ui/alert/AlertDescription.vue';
import AlertTitle from '../../ui/alert/AlertTitle.vue';
import Button from '../../ui/button/Button.vue';
import { cn } from '@/lib/utils';
import {
    AlertCircle,
    AlertTriangle,
    Rocket,
    X,
    XCircle,
} from 'lucide-vue-next';
import { ref, watch } from 'vue';

const props = withDefaults(
    defineProps<{
        title?: 'success' | 'error' | 'warning' | 'info';
        description?: string;
        timestamp?: number;
    }>(),
    {
        title: 'success',
        description: '',
    },
);

const visible = ref(true);

const close = () => {
    visible.value = false;
};

watch(
    () => props.timestamp,
    (newValue) => {
        if (newValue) {
            visible.value = true;
        }
    },
);
</script>

<template>
    <Transition name="close">
        <Alert
            v-if="visible"
            :class="cn('fixed', 'right-4 bottom-8', 'w-96')"
            :variant="title == 'error' ? 'destructive' : 'default'"
        >
            <Rocket v-if="title == 'success'" :class="cn('h-5 w-5')" />
            <AlertCircle v-if="title == 'info'" :class="cn('h-5 w-5')" />
            <AlertTriangle v-if="title == 'warning'" :class="cn('h-5 w-5')" />
            <XCircle v-if="title == 'error'" :class="cn('h-5 w-5')" />

            <AlertTitle v-if="title">
                {{ title.charAt(0).toLocaleUpperCase() + title.slice(1) }}
            </AlertTitle>
            <AlertDescription v-if="description" :class="cn('mt-3')">
                {{ description }}
            </AlertDescription>
            <Button
                :class="cn('absolute top-1 right-1 !p-0')"
                variant="outline"
                size="icon"
                @click="close()"
            >
                <X :class="cn('h-4 w-4', 'text-foreground')" />
            </Button>
        </Alert>
    </Transition>
</template>

<style scoped>
.close-enter-active,
.close-leave-active {
    transition: opacity 0.5s ease-in-out;
}

.close-enter-from,
.close-leave-to {
    opacity: 0;
}

.close-enter-to,
.close-leave-from {
    opacity: 1;
}
</style>
