<script setup lang="ts">
import { cn } from '@/lib/utils';
import notifications from '@/routes/notifications';
import { usePage } from '@inertiajs/vue3';
import { useEchoNotification } from '@laravel/echo-vue';
import axios from 'axios';
import dayjs from 'dayjs';
import relativeTime from 'dayjs/plugin/relativeTime';
import { BellIcon } from 'lucide-vue-next';
import { markRaw, onMounted, ref } from 'vue';
import TextLink from '../TextLink.vue';
import Button from '../ui/button/Button.vue';
import DropdownMenu from '../ui/dropdown-menu/DropdownMenu.vue';
import DropdownMenuContent from '../ui/dropdown-menu/DropdownMenuContent.vue';
import DropdownMenuItem from '../ui/dropdown-menu/DropdownMenuItem.vue';
import DropdownMenuLabel from '../ui/dropdown-menu/DropdownMenuLabel.vue';
import DropdownMenuSeparator from '../ui/dropdown-menu/DropdownMenuSeparator.vue';
import DropdownMenuTrigger from '../ui/dropdown-menu/DropdownMenuTrigger.vue';

const page = usePage();
const user = page.props.auth.user;
const getNotifications = ref<Record<string, any>[]>();
dayjs.extend(relativeTime);
const TextLinkRaw = markRaw(TextLink);
onMounted(async () => {
    const { data } = await axios.get(notifications.index.url());

    getNotifications.value = data;
});

useEchoNotification(`App.Models.User.${user.id}`, (notification) => {
    if (getNotifications.value) {
        getNotifications.value.unshift(notification);
    } else {
        getNotifications.value = [notification];
    }
});

const markAsRead = async (notificationId: string) => {
    await axios.delete(notifications.destroy.url(notificationId));
};
</script>

<template>
    <DropdownMenu>
        <DropdownMenuTrigger>
            <Button
                :class="cn('p-2', 'cursor-pointer')"
                size="icon"
                variant="outline"
                asChild
            >
                <BellIcon :class="cn()" />
            </Button>
        </DropdownMenuTrigger>

        <DropdownMenuContent>
            <DropdownMenuLabel>Notifications</DropdownMenuLabel>
            <DropdownMenuSeparator />
            <DropdownMenuItem
                v-if="getNotifications?.length"
                v-for="notification in getNotifications"
                :class="cn('w-lg', '!no-underline')"
                @click="markAsRead(notification.id)"
                :as="TextLinkRaw"
                :href="notification.data.link"
                :tabindex="-1"
            >
                <div :class="cn('w-full')">
                    {{ notification.data.message }}
                </div>
                <div :class="cn('w-1/4', 'text-center')">
                    {{ dayjs(notification.created_at).fromNow() }}
                </div>
            </DropdownMenuItem>
            <DropdownMenuItem v-else>No notifications</DropdownMenuItem>
        </DropdownMenuContent>
    </DropdownMenu>
</template>

<style scoped></style>
