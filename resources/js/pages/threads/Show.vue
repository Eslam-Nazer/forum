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
import { Auth, type BreadcrumbItem } from '@/types';
import { Head, router, useForm, Form } from '@inertiajs/vue3';
import { MoveLeftIcon } from 'lucide-vue-next';
import Flash from '../accessories/alerts/Flash.vue';
import Reply from '../replies/Reply.vue';
import SubscribeButton from '../threadsupscriptions/SubscribeButton.vue';
import UserAvatar from '@/components/Users/UserAvatar.vue';
import TextLink from '@/components/TextLink.vue';
import Profile from '@/routes/profile';
import replies from '@/routes/replies';
import { ref } from 'vue';
import ThreadDropdown from '@/components/Threads/ThreadDropdown.vue';
import AlgoliaInstant from '@/pages/accessories/Search/AlgoliaInstant.vue';

const props = defineProps<{
    thread: any;
    messages?: Record<'success' | 'error' | 'warning' | 'info', string>;
    auth: Auth
}>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Threads/Show',
        href: threads.show({
            channel: props.thread.channel.slug,
            slug: props.thread.slug
        }).url
    }
];

const body = ref('');

const deleteThread = function() {
    const deleteRoute = threads.destroy({ channel: props.thread.channel.slug, slug: props.thread.slug });

    router[deleteRoute.method](deleteRoute.url);
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
                <MoveLeftIcon />
                Back
            </Button>
        </template>
        <div class="mx-auto mt-4 w-full max-w-4xl">
            <Card class="my-4 p-6">
                <div>
                    <div class="flex items-center justify-between">
                        <div :class="cn('flex justify-center items-center', 'mx-3')">
                            <TextLink
                                :href="Profile.show(thread.creator.name).url"
                            >
                                <UserAvatar :user="thread.creator" size="base" class="mr-2" />
                            </TextLink>

                            <h2 class="text-2xl">
                                {{ thread.creator.name }} posted:
                                {{ thread.title }}
                            </h2>
                        </div>
                        <div :class="cn('flex gap-2')">
                            <ThreadDropdown
                                :thread="thread"
                                :auth="auth"
                            />
                        </div>
                    </div>
                    <hr
                        class="my-8 h-px border-0 bg-gray-200 dark:bg-gray-500"
                    />
                    <div class="text-xl">
                        <p>content: {{ thread.body }}</p>
                    </div>
                </div>
            </Card>
            <Card class="p-6">
                <h2 class="text-lg">Replies:</h2>
                <Reply
                    v-for="reply in thread.replies"
                    :key="reply.id"
                    :reply="reply"
                    :isThreadOwner="auth.user.id === thread.creator.id"
                />
                <div class="text-center" v-if="thread.locked">
                    Thread is locked. Can't add any replies now.
                </div>
                <Form
                    :action="replies.store({threadSlug: thread.slug}).url"
                    method="post"
                    #default="{errors}"
                    @success="body = ''"
                    :options="{preserveScroll: true}"
                    v-else
                >
                    <Textarea name="body" v-model="body" @keydown.enter="$event.target.form.requestSubmit()" />
                    <InputError :message="errors.body" />
                    <Button type="submit" class="mt-3 cursor-pointer">reply</Button>
                </Form>
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
