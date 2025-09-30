<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import Button from '@/components/ui/button/Button.vue';
import Card from '@/components/ui/card/Card.vue';
import { Textarea } from '@/components/ui/textarea';
import AppLayout from '@/layouts/AppLayout.vue';
import threads from '@/routes/threads';
import replies from '@/routes/threads/replies';
import { type BreadcrumbItem } from '@/types';
import { Head, useForm } from '@inertiajs/vue3';
import Reply from '../replies/Reply.vue';

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

const emit = defineEmits<{
    (e: 'update:editing', value: boolean): void;
}>();

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
                <Reply
                    v-for="reply in props.thread.replies"
                    :key="reply.id"
                    :reply="reply"
                />
                <form @submit.prevent="storeReply">
                    <Textarea v-model="formCreateReply.body" />
                    <InputError :message="formCreateReply.errors.body" />
                    <Button class="mt-3 cursor-pointer">reply</Button>
                </form>
            </Card>
        </div>
    </AppLayout>
</template>
