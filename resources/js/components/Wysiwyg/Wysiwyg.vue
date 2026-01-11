<script setup lang="ts">
import { useEditor, EditorContent } from '@tiptap/vue-3';
import StarterKit from '@tiptap/starter-kit';

const editor = useEditor({
    content: '<p>I\'m running Tiptap with Vue.js. 🎉</p>',
    extensions: [
        StarterKit
    ],
    editorProps: {
        attributes: {
            class: 'border border-gray-400 p-4 min-h-[12rem] max-h-[14rem] outline-none'
        }
    }
});
</script>

<template>
    <div class="container mx-auto my-8">
        <section v-if="editor"
                 class="felx items-center flex-wrap gap-x-4 border-t border-r border-l border-gray-400 p-4">
            <button
                @click="editor.chain().focus().toggleBold().run()"
                :disabled="!editor.can().chain().focus().toggleBold().run()"
                :class="{ 'bg-gray-200 dark:bg-gray-700': editor.isActive('bold') }"
                class="p-1 rounded"
            >
                bold
            </button>
            <button
                @click="editor.chain().focus().toggleItalic().run()"
                :disabled="!editor.can().chain().focus().toggleItalic().run()"
                :class="{ 'bg-gray-200 dark:bg-gray-700': editor.isActive('italic') }"
                class="p-1 rounded"
            >
                italic
            </button>
            <button
                @click="editor.chain().focus().toggleUnderline().run()"
                :disabled="!editor.can().chain().focus().toggleUnderline().run()"
                :class="{ 'bg-gray-200 dark:bg-gray-700': editor.isActive('underline') }"
                class="p-1 rounded"
            >
                underline
            </button>
            <button
                @click="editor.chain().focus().toggleHeading({level: 1}).run()"
                :disabled="!editor.can().chain().focus().toggleHeading({level: 1}).run()"
                :class="{ 'bg-gray-200 dark:bg-gray-700': editor.isActive('heading', {level: 1}) }"
                class="p-1 rounded"
            >
                H1
            </button>
            <button
                @click="editor.chain().focus().toggleHeading({level: 2}).run()"
                :disabled="!editor.can().chain().focus().toggleHeading({level: 2}).run()"
                :class="{ 'bg-gray-200 dark:bg-gray-700': editor.isActive('heading', {level: 2}) }"
                class="p-1 rounded"
            >
                H2
            </button>
            <button
                @click="editor.chain().focus().toggleBulletList().run()"
                :disabled="!editor.can().chain().focus().toggleBulletList().run()"
                :class="{ 'bg-gray-200 dark:bg-gray-700': editor.isActive('bulletList') }"
                class="p-1 rounded"
            >
                List
            </button>
        </section>
        <EditorContent :editor="editor" />
    </div>
</template>

<style scoped>
@reference "tailwindcss";

:deep(.tiptap > :first-child) {
    @apply mt-0
}

:deep(.tiptap h1) {
    @apply text-xl mt-14 mb-6 leading-tight
}

:deep(.tiptap h2) {
    @apply text-lg mt-10 mb-4 leading-tight
}

:deep(.tiptap ul),
:deep(.tiptap ol) {
    @apply list-disc list-outside pl-6 my-5;
}

:deep(.tiptap ol) {
    @apply list-decimal;
}

:deep(.tiptap li p) {
    @apply my-1;
}
</style>
