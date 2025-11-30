<script setup lang="ts">

import AppLayout from '@/layouts/AppLayout.vue';
import { Auth, BreadcrumbItem, User } from '@/types';
import profile from '@/routes/profile';
import { Head, usePage } from '@inertiajs/vue3';
import { cn, formatDate, shorten } from '@/lib/utils';
import TextLink from '@/components/TextLink.vue';
import UserAvatar from '@/components/Users/UserAvatar.vue';

interface Profile extends User {
    threads: any[];
    replies: any[];
}

const props = defineProps<{
    auth: Auth,
    user: Profile,
}>();

// const page = usePage();
// const segments = page.url.split('/').filter(Boolean);

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: props.user.name + ' Profile',
        href: profile.show(props.auth.user.name).url
    }
];
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <Head title="Profile" />

        <div :class="cn('w-full', 'max-w-md', 'mx-auto', 'mt-30' , 'mb-15', 'border-2', 'p-8', 'rounded-xl')">
            <div :class="cn('flex justify-center items-center flex-col')">
                <div :class="cn('flex justify-center items-center', 'mb-3')">
                    <UserAvatar :user="user" size="lg" />
                </div>
                <h2 :class="cn('text-center', 'text-2xl', 'font-semibold')">{{ user.name }}</h2>
                <span :class="cn('font-semibold', 'text-xl')">{{ user.email }}</span>
            </div>
            <div :class="cn('space-y-4', 'text-lg','font-semibold')">
                <div :class="cn('flex justify-between items-center')">
                    <span>Username</span>
                    <span>{{ user.name }}</span>
                </div>
                <div :class="cn('flex justify-between items-center')">
                    <span>Email</span>
                    <span>{{ user.email }}</span>
                </div>
                <div :class="cn('flex justify-between items-center')">
                    <span>Joined</span>
                    <span>{{ formatDate(user.created_at) }}</span>
                </div>
            </div>
        </div>
        <div :class="cn('w-full', 'max-w-3xl', 'mx-auto', 'border-2', 'rounded-xl')">
            <div :class="cn('p-5')">
                <h2 :class="cn('text-xl', 'font-semibold')">Threads: </h2>
                <div :class="cn('pl-3')" v-if="user.threads.length !== 0" v-for="thread in user.threads">
                    <TextLink :href="thread.path_to">{{ shorten(thread.title, 20) }}</TextLink>
                    posted at <span :class="cn('font-semibold')">{{ formatDate(thread.created_at) }}</span>
                </div>
                <div :class="cn('pl-3', 'text-lg', 'font-semibold')" v-else>
                    {{ user.name }} has not yet posted threads.
                </div>
            </div>
            <hr />
            <div :class="cn('p-5')">
                <h2 :class="cn('text-xl', 'font-semibold')">Replies</h2>
                <div :class="cn('pl-3')" v-if="user.replies.length !== 0" v-for="reply in user.replies">
                    Replied a
                    <TextLink :href="reply.path_to">{{ shorten(reply.body) }}</TextLink>
                    at
                    <span :class="cn('font-semibold')">{{ formatDate(reply.created_at) }}</span>
                </div>
                <div :class="cn('pl-3', 'text-lg', 'font-semibold')" v-else>
                    {{ user.name }} has not yet replied in threads.
                </div>
            </div>
        </div>

    </AppLayout>
</template>

<style scoped>

</style>
