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
import { computed, markRaw } from 'vue';
import TextLink from '@/components/TextLink.vue';
import subscribe from '@/routes/threads/subscribe';
import LockThreads from '@/routes/lock-threads';

const props = defineProps<{
    thread: Thread;
    auth: Auth;
}>();

const tabIndexValue = computed(() => -1);
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
                <DropdownMenuItem v-if="thread.locked" asChild>
                    <TextLink
                        class="w-full !no-underline"
                        :href="LockThreads.destroy({slug: thread.slug})"
                        :tabindex="tabIndexValue"
                    >
                        <LockOpen />
                        Unlock
                    </TextLink>
                </DropdownMenuItem>
                <DropdownMenuItem v-else asChild>
                    <TextLink
                        class="w-full !no-underline"
                        :href="LockThreads.store({slug: thread.slug})"
                        :tabindex="tabIndexValue"
                    >
                        <Lock />
                        Lock
                    </TextLink>
                </DropdownMenuItem>
            </DropdownMenuGroup>
            <DropdownMenuGroup>
                <DropdownMenuItem v-if="thread.is_subscribed" asChild>
                    <TextLink
                        class="w-full !no-underline"
                        :href="subscribe.destroy({channel: thread.channel.slug, slug: thread.slug})"
                        :tabindex="tabIndexValue"
                    >
                        <BellAlertIcon />
                        Unsubscribe
                    </TextLink>
                </DropdownMenuItem>
                <DropdownMenuItem
                    v-else
                    asChild
                >
                    <TextLink
                        :href="subscribe.store({channel: thread.channel.slug, slug: thread.slug })"
                        :tabindex="tabIndexValue"
                        class="w-full !no-underline"
                    >
                        <BellPlusIcon />
                        Subscribe
                    </TextLink>
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
