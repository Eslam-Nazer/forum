<script setup lang="ts">
import TextLink from '@/components/TextLink.vue';
import Button from '@/components/ui/button/Button.vue';
import { cn } from '@/lib/utils';
import subscribe from '@/routes/threads/subscribe';
import { BellAlertIcon } from '@heroicons/vue/20/solid';
import { BellPlusIcon } from 'lucide-vue-next';
import { markRaw } from 'vue';

const props = defineProps<{
    channelSlug: string;
    threadId: string | number;
    isSubscribedTo?: boolean;
}>();

const TextLinkRaw = markRaw(TextLink);
</script>

<template>
    <Button
        :variant="isSubscribedTo ? 'destructive' : 'secondary'"
        size="default"
        :class="cn('cursor-pointer', '!no-underline')"
        :as="TextLinkRaw"
        :href="
            isSubscribedTo
                ? subscribe.destroy({
                      channel: channelSlug,
                      thread: threadId,
                  })
                : subscribe.store({
                      channel: channelSlug,
                      thread: threadId,
                  })
        "
        :method="isSubscribedTo ? 'delete' : 'post'"
    >
        <BellPlusIcon v-if="!isSubscribedTo" :class="cn('h2 w-2')" />
        <BellAlertIcon v-else :class="cn('h2 w-2')" />
        {{ isSubscribedTo ? 'Unsubscribe' : 'Subscribe' }}
    </Button>
</template>
