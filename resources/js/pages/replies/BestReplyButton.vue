<script setup lang="ts">

import { cn } from '@/lib/utils';
import { MessageCircleHeart } from 'lucide-vue-next';
import TextLink from '@/components/TextLink.vue';
import BestReply from '@/routes/best-reply';

const props = withDefaults(defineProps<{
    reply: any
    isThreadOwner?: boolean
}>(), {
    isThreadOwner: false
});

let storeBestReply = BestReply.store({ id: props.reply.id });
let deleteBestReply = BestReply.destroy({ id: props.reply.id });
</script>

<template>
    <TextLink
        v-if="isThreadOwner"
        :href="reply.is_best ? deleteBestReply.url : storeBestReply.url"
        :class="cn('mr-2')"
        :method="reply.is_best ? deleteBestReply.method : storeBestReply.method"
    >
        <MessageCircleHeart :class="{
            'text-yellow-500': reply.is_best
        }" />
    </TextLink>
</template>
<style scoped>

</style>
