<script setup lang="ts">

import {
    DropdownMenu,
    DropdownMenuContent, DropdownMenuGroup,
    DropdownMenuItem, DropdownMenuLabel, DropdownMenuSeparator,
    DropdownMenuTrigger
} from '@/components/ui/dropdown-menu';
import { Button } from '@/components/ui/button';
import { EllipsisVertical, Lock, LockOpen, BellPlusIcon, Trash2Icon } from 'lucide-vue-next';
import { BellAlertIcon } from '@heroicons/vue/20/solid';
import { Auth, Thread } from '@/types';
import { markRaw } from 'vue';
import TextLink from '@/components/TextLink.vue';
import subscribe from '@/routes/threads/subscribe';

const props = defineProps<{
    thread: Thread;
    auth: Auth;
}>();

// const TextLinkRaw = markRaw(TextLink);
</script>

<template>
    <DropdownMenu>
        <DropdownMenuTrigger as-child>
            <Button variant="outline" size="icon">
                <EllipsisVertical />
            </Button>
        </DropdownMenuTrigger>
        <DropdownMenuContent align="end">
            <DropdownMenuLabel>Threads Actions</DropdownMenuLabel>
            <DropdownMenuGroup v-if="auth.user.id === thread.user_id">
                <DropdownMenuItem v-if="thread.locked">
                    <LockOpen />
                    Unlock
                </DropdownMenuItem>
                <DropdownMenuItem v-else>
                    <Lock />
                    Lock
                </DropdownMenuItem>
            </DropdownMenuGroup>
            <DropdownMenuGroup>
                <DropdownMenuItem v-if="thread.is_subscribed">
                    <BellAlertIcon />
                    Unsubscribe
                </DropdownMenuItem>
                <DropdownMenuItem
                    :as="TextLink"
                    :href="subscribe.store({channel: thread.channel.slug, })"
                    v-else
                >
                    <BellPlusIcon />
                    Subscribe
                </DropdownMenuItem>
            </DropdownMenuGroup>
            <DropdownMenuSeparator />
            <DropdownMenuGroup>
                <DropdownMenuItem class="bg-red-800" v-if="auth.user.id === thread.user_id">
                    <Trash2Icon />
                    Delete Thread
                </DropdownMenuItem>
            </DropdownMenuGroup>
        </DropdownMenuContent>
    </DropdownMenu>
</template>

<style scoped>

</style>
