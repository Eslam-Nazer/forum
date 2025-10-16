<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import AlertDialog from '@/components/ui/alert-dialog/AlertDialog.vue';
import AlertDialogAction from '@/components/ui/alert-dialog/AlertDialogAction.vue';
import AlertDialogCancel from '@/components/ui/alert-dialog/AlertDialogCancel.vue';
import AlertDialogContent from '@/components/ui/alert-dialog/AlertDialogContent.vue';
import AlertDialogDescription from '@/components/ui/alert-dialog/AlertDialogDescription.vue';
import AlertDialogFooter from '@/components/ui/alert-dialog/AlertDialogFooter.vue';
import AlertDialogHeader from '@/components/ui/alert-dialog/AlertDialogHeader.vue';
import AlertDialogTitle from '@/components/ui/alert-dialog/AlertDialogTitle.vue';
import AlertDialogTrigger from '@/components/ui/alert-dialog/AlertDialogTrigger.vue';
import Button from '@/components/ui/button/Button.vue';
import Card from '@/components/ui/card/Card.vue';
import { Textarea } from '@/components/ui/textarea';
import AppLayout from '@/layouts/AppLayout.vue';
import { cn } from '@/lib/utils';
import threads from '@/routes/threads';
import replies from '@/routes/threads/replies';
import { type BreadcrumbItem } from '@/types';
import { Head, router, useForm } from '@inertiajs/vue3';
import { MoveLeftIcon } from 'lucide-vue-next';
import Flash from '../accessories/alerts/Flash.vue';
import Reply from '../replies/Reply.vue';
import SubscribeButton from '../threadsupscriptions/SubscribeButton.vue';

const props = defineProps<{
    thread: any;
    messages?: Record<'success' | 'error' | 'warning' | 'info', string>;
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

const deleteThread = function () {
    router.delete(
        threads.destroy({
            channel: props.thread.channel.slug,
            id: props.thread.id,
        }),
    );
};

const goBack = () => {
    if (window.history.length > 1) {
        window.history.back();
    } else if (document.referrer) {
        router.visit(threads.index());
    }
};
</script>

<template>
    <Head title="Thread" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <template #header-actions>
            <Button
                @click="goBack"
                :class="cn('cursor-pointer', '!no-underline')"
                variant="secondary"
            >
                <MoveLeftIcon /> Back
            </Button>
        </template>
        <div class="mx-auto mt-4 w-full max-w-4xl">
            <Card class="my-4 p-6">
                <div>
                    <div class="flex items-center justify-between">
                        <h2 class="text-2xl">
                            {{ props.thread.creator.name }} posted:
                            {{ props.thread.title }}
                        </h2>
                        <div :class="cn('flex gap-2')">
                            <AlertDialog>
                                <AlertDialogTrigger>
                                    <Button
                                        v-if="props.thread.can.delete"
                                        type="button"
                                        variant="destructive"
                                        :class="cn('cursor-pointer')"
                                    >
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
                                        <AlertDialogCancel
                                            >Cancel</AlertDialogCancel
                                        >
                                        <AlertDialogAction
                                            :class="
                                                cn(
                                                    'text-white',
                                                    'bg-red-900 hover:bg-red-800',
                                                )
                                            "
                                            @click="deleteThread"
                                        >
                                            Delete
                                        </AlertDialogAction>
                                    </AlertDialogFooter>
                                </AlertDialogContent>
                            </AlertDialog>
                            <SubscribeButton
                                :channelSlug="thread.channel.slug"
                                :threadId="thread.id"
                                :isSubscribedTo="thread.isSubscribedTo"
                            />
                        </div>
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
                <form
                    @submit.prevent="storeReply"
                    @keydown.enter.prevent="storeReply"
                >
                    <Textarea v-model="formCreateReply.body" />
                    <InputError :message="formCreateReply.errors.body" />
                    <Button class="mt-3 cursor-pointer">reply</Button>
                </form>
            </Card>
        </div>
        <Flash
            v-if="messages"
            v-for="(message, type) in messages"
            :title="type"
            :description="message"
            :timestamp="Date.now()"
        />
    </AppLayout>
</template>
