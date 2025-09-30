<script setup lang="ts">
import TextLink from '@/components/TextLink.vue';
import Button from '@/components/ui/button/Button.vue';
import Card from '@/components/ui/card/Card.vue';
import Textarea from '@/components/ui/textarea/Textarea.vue';
import favorite from '@/routes/favorite';
import replies from '@/routes/threads/replies';
import { useForm } from '@inertiajs/vue3';
import dayjs from 'dayjs';
import relativeTime from 'dayjs/plugin/relativeTime';
import { ref } from 'vue';

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

dayjs.extend(relativeTime);
</script>

<template>
    <Card class="gap-2 p-4">
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
        <div>
            <div v-if="isEditing" class="my-4">
                <Textarea v-model="fromReply.body" />
                <Button class="mt-3 cursor-pointer" @click="update"
                    >update</Button
                >
                <Button class="mt-3 ml-2 cursor-pointer" @click="toggleEditing"
                    >cancel</Button
                >
            </div>
            <div v-else>
                <div class="text-md">{{ reply.body }}</div>
            </div>
            <!-- i need check first if user authorized to edit it or not -->
            <div class="mt-2 flex items-center">
                <Button
                    v-if="reply.can.update && !isEditing"
                    @click="toggleEditing"
                    class="mr-2 cursor-pointer"
                >
                    edit
                </Button>
                <Button
                    v-if="reply.can.delete && !isEditing"
                    class="mr-2 cursor-pointer"
                >
                    remove reply
                </Button>
            </div>
        </div>
    </Card>
</template>
