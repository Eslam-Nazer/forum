<script setup lang="ts">
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
import Textarea from '@/components/ui/textarea/Textarea.vue';
import replies from '@/routes/threads/replies';
import { useForm } from '@inertiajs/vue3';
import dayjs from 'dayjs';
import relativeTime from 'dayjs/plugin/relativeTime';
import { ref } from 'vue';
import FavoriteButton from '../favorites/FavoriteButton.vue';

const props = defineProps<{
    reply: any;
}>();

const isEditing = ref(false);

const fromReply = useForm({
    body: props.reply.body,
});

function toggleEditing() {
    isEditing.value = !isEditing.value;
}

function update() {
    fromReply.patch(
        replies.update({
            id: props.reply.id,
        }).url,
        {
            preserveScroll: true,
            onSuccess: () => {
                isEditing.value = false;
            },
        },
    );
    
}

function destroy() {
    fromReply.delete(
        replies.destroy({
            id: props.reply.id,
        }).url,
        {
            preserveScroll: true,
        },
    );
}

dayjs.extend(relativeTime);
</script>

<template>
    <Card class="gap-2 p-4">
        <div class="flex items-center justify-between">
            <h2 class="text-md">
                {{ reply.owner.name }} replied at:
                {{ dayjs(reply.created_at).fromNow() }}
                <span v-if="reply.updated_at !== reply.created_at">
                    &amp; updated at:
                    {{ dayjs(reply.updated_at).fromNow() }}
                </span>
            </h2>
            <div class="flex flex-col items-center justify-center">
                <FavoriteButton :model="reply" :type="'replies'" />
            </div>
        </div>
        <div>
            <div v-if="isEditing" class="my-4">
                <Textarea v-model="fromReply.body" />
                <Button class="mt-3 cursor-pointer" @click="update">
                    update
                </Button>
                <AlertDialog>
                    <AlertDialogTrigger>
                        <Button class="mt-3 ml-2 cursor-pointer">
                            cancel
                        </Button>
                    </AlertDialogTrigger>
                    <AlertDialogContent>
                        <AlertDialogHeader>
                            <AlertDialogTitle>
                                Are you sure to cancel?
                            </AlertDialogTitle>
                            <AlertDialogDescription>
                                When you confirm this action, your changes will
                                not be saved
                            </AlertDialogDescription>
                        </AlertDialogHeader>
                        <AlertDialogFooter>
                            <AlertDialogCancel>Cancel</AlertDialogCancel>
                            <AlertDialogAction @click="toggleEditing">
                                Confirm
                            </AlertDialogAction>
                        </AlertDialogFooter>
                    </AlertDialogContent>
                </AlertDialog>
            </div>
            <div v-else>
                <div class="text-md">{{ reply.body }}</div>
            </div>
            <div class="mt-2 flex items-center">
                <Button
                    v-if="reply.can.update && !isEditing"
                    @click="toggleEditing"
                    class="mr-2 cursor-pointer"
                >
                    edit
                </Button>
                <AlertDialog>
                    <AlertDialogTrigger>
                        <Button
                            v-if="reply.can.delete && !isEditing"
                            class="mr-2 cursor-pointer"
                        >
                            remove reply
                        </Button>
                    </AlertDialogTrigger>

                    <AlertDialogContent>
                        <AlertDialogHeader>
                            <AlertDialogTitle>
                                Are you sure to delete reply?
                            </AlertDialogTitle>
                            <AlertDialogDescription>
                                When you confirm this action, this reply will be
                                deleted
                            </AlertDialogDescription>
                        </AlertDialogHeader>
                        <AlertDialogFooter>
                            <AlertDialogCancel>Cancel</AlertDialogCancel>
                            <AlertDialogAction @click="destroy">
                                Confirm
                            </AlertDialogAction>
                        </AlertDialogFooter>
                    </AlertDialogContent>
                </AlertDialog>
            </div>
        </div>
    </Card>
</template>
