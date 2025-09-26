<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import Button from '@/components/ui/button/Button.vue';
import Card from '@/components/ui/card/Card.vue';
import { Textarea } from '@/components/ui/textarea';
import AppLayout from '@/layouts/AppLayout.vue';
import favorite from '@/routes/favorite';
import threads from '@/routes/threads';
import replies from '@/routes/threads/replies';
import { type BreadcrumbItem } from '@/types';
import { Head, useForm } from '@inertiajs/vue3';
import dayjs from 'dayjs';
import relativeTime from 'dayjs/plugin/relativeTime';

const props = defineProps<{
    thread: any;
}>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Threads/Show',
        href: threads.show({
            channel: props.thread.channel.slug,
            id: props.thread.id,
        }).url,
    },
];

const formCreateReply = useForm({
    body: '',
});
const storeReply = function () {
    formCreateReply.post(
        replies.store({
            channel: props.thread.channel.slug,
            threadId: props.thread.id,
        }).url,
        {
            preserveScroll: true,
            onSuccess: () => formCreateReply.reset(),
        },
    );
};

dayjs.extend(relativeTime);
</script>

<template>
    <Head title="Thread" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="mx-auto mt-4 w-full max-w-4xl">
            <Card class="my-4 p-6">
                <div>
                    <div class="flex items-center justify-between">
                        <h2 class="text-2xl">
                            {{ props.thread.creator.name }} posted:
                            {{ props.thread.title }}
                        </h2>
                        <button
                            v-show="props.thread.can.delete"
                            type="button"
                            class="text-md cursor-pointer rounded-lg bg-blue-700 px-3 py-2 text-center font-medium text-white hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 focus:outline-none dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        >
                            <!-- i need check first if user authorized to delete it or not -->
                            Delete Thread
                        </button>
                    </div>
                    <hr
                        class="my-8 h-px border-0 bg-gray-200 dark:bg-gray-500"
                    />
                    <div class="text-xl">
                        <p>content: {{ props.thread.body }}</p>
                    </div>
                </div>
            </Card>
            <Card class="p-6">
                <h2 class="text-lg">Replies:</h2>
                <Card
                    class="gap-2 p-4"
                    v-for="reply in thread.replies"
                    :key="reply.id"
                >
                    <div class="flex items-center justify-between">
                        <h2 class="text-md">
                            {{ reply.owner.name }} replied at:
                            {{ dayjs(reply.created_at).fromNow() }}
                        </h2>
                        <div class="flex flex-col items-center justify-center">
                            <TextLink
                                :href="
                                    favorite.store({
                                        type: 'replies',
                                        id: reply.id,
                                    })
                                "
                                :method="'post'"
                                :class="{
                                    'text-red-400': reply.is_favorite,
                                }"
                                class="cursor-pointer"
                                preserve-scroll
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24"
                                    fill="currentColor"
                                    class="size-6"
                                >
                                    <path
                                        d="m11.645 20.91-.007-.003-.022-.012a15.247 15.247 0 0 1-.383-.218 25.18 25.18 0 0 1-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0 1 12 5.052 5.5 5.5 0 0 1 16.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 0 1-4.244 3.17 15.247 15.247 0 0 1-.383.219l-.022.012-.007.004-.003.001a.752.752 0 0 1-.704 0l-.003-.001Z"
                                    />
                                </svg>
                            </TextLink>
                            <span>{{ reply.favorites_count }}</span>
                        </div>
                    </div>
                    <div class="text-md">{{ reply.body }}</div>
                    <!-- i need check first if user authorized to edit it or not -->
                    <div class="flex items-center">
                        <Button v-show="reply.can.update" class="mr-2 cursor-pointer"> edit </Button>
                        <Button v-show="reply.can.delete" class="mr-2 cursor-pointer">
                            remove reply
                        </Button>
                    </div>
                </Card>
                <form @submit.prevent="storeReply">
                    <Textarea v-model="formCreateReply.body" />
                    <InputError :message="formCreateReply.errors.body" />
                    <Button class="mt-3 cursor-pointer">reply</Button>
                </form>
            </Card>
        </div>
    </AppLayout>
</template>
