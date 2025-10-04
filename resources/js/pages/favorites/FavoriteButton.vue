<script setup lang="ts">
import TextLink from '@/components/TextLink.vue';
import favorite from '@/routes/favorite';
import { HeartIcon } from '@heroicons/vue/20/solid';

const props = defineProps<{
    model: any;
    type: string;
}>();
</script>

<template>
    <TextLink
        :href="
            favorite.store({
                type: type,
                id: model.id,
            })
        "
        :method="'post'"
        :class="{
            'text-red-400': model.is_favorite,
        }"
        class="cursor-pointer"
        preserve-scroll
    >
        <HeartIcon class="h-6 w-6" />
    </TextLink>
    <span>{{ model.favorites_count }}</span>
</template>
