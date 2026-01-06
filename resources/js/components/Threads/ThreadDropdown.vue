<script setup lang="ts">

import {
    DropdownMenu,
    DropdownMenuContent, DropdownMenuGroup,
    DropdownMenuItem, DropdownMenuLabel, DropdownMenuSeparator,
    DropdownMenuTrigger
} from '@/components/ui/dropdown-menu';
import {
    AlertDialog,
    AlertDialogAction,
    AlertDialogCancel,
    AlertDialogContent,
    AlertDialogDescription,
    AlertDialogFooter,
    AlertDialogHeader,
    AlertDialogTitle,
    AlertDialogTrigger
} from '@/components/ui/alert-dialog';
import { Button } from '@/components/ui/button';
import { EllipsisVertical, Lock, LockOpen, BellPlusIcon, Trash2Icon, SquarePenIcon } from 'lucide-vue-next';
import { BellAlertIcon } from '@heroicons/vue/20/solid';
import { Auth, Thread } from '@/types';
import { computed } from 'vue';
import TextLink from '@/components/TextLink.vue';
import subscribe from '@/routes/threads/subscribe';
import lock from '@/routes/threads/lock';
import threads from '@/routes/threads';

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
                        :href="lock.destroy({slug: thread.slug})"
                        :tabindex="tabIndexValue"
                    >
                        <LockOpen />
                        Unlock
                    </TextLink>
                </DropdownMenuItem>
                <DropdownMenuItem v-else asChild>
                    <TextLink
                        class="w-full !no-underline"
                        :href="lock.store({slug: thread.slug})"
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
                <DropdownMenuItem
                    v-if="thread.user_id === auth.user.id"
                    asChild
                >
                    <TextLink
                        :href="threads.edit({channel: thread.channel.slug, slug: thread.slug})"
                        :tabindex="tabIndexValue"
                        class="w-full !no-underline"
                    >
                        <SquarePenIcon />
                        Edit
                    </TextLink>
                </DropdownMenuItem>
            </DropdownMenuGroup>
            <DropdownMenuSeparator />

            <DropdownMenuGroup>
                <DropdownMenuItem v-if="thread.can.delete" asChild>
                    <AlertDialog>
                        <AlertDialogTrigger>
                            <Button
                                type="button"
                                variant="destructive"
                                class="cursor-pointer m-0.5"
                            >
                                <Trash2Icon />
                                Delete Thread
                            </Button>
                        </AlertDialogTrigger>
                        <AlertDialogContent>
                            <AlertDialogHeader>
                                <AlertDialogTitle>
                                    Are you sure to delete thread?
                                </AlertDialogTitle>
                                <AlertDialogDescription>
                                    When you confirm this action, this
                                    thread will be deleted
                                </AlertDialogDescription>
                            </AlertDialogHeader>
                            <AlertDialogFooter>
                                <AlertDialogCancel>
                                    Cancel
                                </AlertDialogCancel>
                                <AlertDialogAction
                                    class="text-white bg-red-900 hover:bg-red-700"
                                    asChild
                                >
                                    <TextLink
                                        :href="threads.destroy({channel: thread.channel.slug, slug: thread.slug})"
                                        class="!no-underline"
                                    >
                                        Delete
                                    </TextLink>
                                </AlertDialogAction>
                            </AlertDialogFooter>
                        </AlertDialogContent>
                    </AlertDialog>

                </DropdownMenuItem>
            </DropdownMenuGroup>
        </DropdownMenuContent>
    </DropdownMenu>
</template>

<style scoped>
</style>
