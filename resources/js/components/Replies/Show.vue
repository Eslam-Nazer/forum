<script setup lang="ts">
import Button from '@/components/ui/button/Button.vue';
import Card from '@/components/ui/card/Card.vue';
import { useHashScroll } from '@/composables/useHashScroll';
import dayjs from 'dayjs';
import relativeTime from 'dayjs/plugin/relativeTime';
import { ref } from 'vue';
import FavoriteButton from '@/pages/favorites/FavoriteButton.vue';
import ToggleBestButton from '@/components/Replies/ToggleBestButton.vue';
import replies from '@/routes/replies';
import { Reply } from '@/types';
import AlertConfirmation from '@/components/accessories/AlertConfimation/AlertConfirmation.vue';
import { useReplyForm } from '@/composables/useReplyForm';
import TiptapEditor from '@/components/Wysiwyg/TiptapEditor.vue';
import InputError from '@/components/InputError.vue';

const props = withDefaults(defineProps<{
    reply: Reply;
    isThreadOwner?: boolean;
}>(), {
    isThreadOwner: false
});

const isEditing = ref(false);
dayjs.extend(relativeTime);
useHashScroll();

function toggleEditing() {
    isEditing.value = !isEditing.value;
}

const { form, update: updateReply, destroy: destroyReply } = useReplyForm(props.reply);

const update = () => {
    const success = () => isEditing.value = false;
    return updateReply(replies.update({ id: props.reply.id }).url, success);
};

const destroy = () => {
    return destroyReply(replies.destroy({ id: props.reply.id }).url);
};
</script>

<template>

    <Card class="gap-2 p-4" :id="'reply-' + reply.id">

        <div class="flex items-center justify-between">
            <h2 class="text-md">
                {{ reply.owner.name }} replied at:
                {{ dayjs(reply.created_at).fromNow() }}
                <span v-if="reply.updated_at !== reply.created_at">
                    &amp; updated at:
                    {{ dayjs(reply.updated_at).fromNow() }}
                </span>
            </h2>

            <div class="flex items-center justify-center">
                <ToggleBestButton :reply="reply" :isThreadOwner="isThreadOwner" />
                <FavoriteButton :model="reply" :type="'replies'" />
            </div>
        </div>

        <div>
            <div v-if="isEditing" class="my-4">
                <tiptap-editor v-model="form.body" />
                <InputError :message="form.errors.body" />

                <div class="space-x-2">
                    <Button class="mt-3 cursor-pointer" @click="update">
                        Update
                    </Button>

                    <AlertConfirmation
                        action-button="Cancel"
                        title="Are you sure to cancel?"
                        description="When you confirm this action, your changes will not be saved"
                        continueText="Confirm"
                        @confirm="toggleEditing"
                    />
                </div>
            </div>

            <div v-else>
                <div class="prose dark:prose-invert max-w-none" v-html="reply.body"></div>
            </div>

            <div class="mt-2 flex items-center">

                <Button
                    v-if="reply.can.update && !isEditing"
                    @click="toggleEditing"
                    class="mr-2 cursor-pointer"
                >
                    Edit
                </Button>

                <AlertConfirmation
                    v-if="reply.can.delete && !isEditing"
                    variant="destructive"
                    action-button="remove"
                    title="Are you sure to delete reply?"
                    description="When you confirm this action, this reply will be deleted"
                    continueVariant="destructive"
                    @confirm="destroy"
                />
            </div>
        </div>
    </Card>
</template>
