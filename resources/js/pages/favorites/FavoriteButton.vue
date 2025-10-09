<script setup lang="ts">
import TextLink from '@/components/TextLink.vue';
import favorite from '@/routes/favorite';
import { HeartIcon } from '@heroicons/vue/20/solid';
import { computed } from 'vue';

const props = defineProps<{
    model: any;
    type: string;
}>();

const attributes = computed(() => ({
    type: props.type,
    id: props.model.id,
}));

const create = computed(() => favorite.store(attributes.value));

const destroy = computed(() => favorite.destroy(attributes.value));
</script>

<template>
    <TextLink :href="model.is_favorite ? destroy.url : create.url"
        :method="model.is_favorite ? destroy.method : create.method" :class="{
            'text-red-400': model.is_favorite,
        }" class="cursor-pointer" preserve-scroll>
        <HeartIcon class="h-6 w-6" />
    </TextLink>
    <span>{{ model.favorites_count }}</span>
</template>
