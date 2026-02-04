<script setup lang="ts">
import Button from '@/components/ui/button/Button.vue';
import InputError from '@/components/InputError.vue';
import TiptapEditor from '@/components/Wysiwyg/TiptapEditor.vue';
import { useReplyForm } from '@/composables/useReplyForm';
import replies from '@/routes/replies';

const { form, store } = useReplyForm();

const props = defineProps<{
    threadSlug: string
}>();

</script>

<template>
    <form
        @submit.prevent="store(replies.store({ threadSlug: props.threadSlug }).url)"
    >
        <tiptap-editor v-model="form.body" />
        <InputError :message="form.errors.body" />
        <Button type="submit" class="mt-3 cursor-pointer">reply</Button>
    </form>
</template>

<style scoped>

</style>
