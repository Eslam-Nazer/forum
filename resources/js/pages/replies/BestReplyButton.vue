<script setup lang="ts">

import { cn } from '@/lib/utils';
import { MessageCircleHeart } from 'lucide-vue-next';
import TextLink from '@/components/TextLink.vue';
import BestReply from '@/routes/best-reply';

const props = withDefaults(defineProps<{
    reply: any
    isThreadOwner?: boolean
}>(), {
    isThreadOwner: false,
});

let bestReply = BestReply.store({id: props.reply.id})
</script>

<template>
    <TextLink
        v-if="isThreadOwner"
        :href="bestReply.url"
        :class="cn('mr-2')"
        method="post"
    >
        <MessageCircleHeart :class="{
            'text-yellow-500': reply.is_best
        }" />
    </TextLink>
</template>
<style scoped>

</style>
