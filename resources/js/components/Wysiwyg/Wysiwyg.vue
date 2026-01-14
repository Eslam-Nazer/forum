<script setup lang="ts">
import { useEditor, EditorContent } from '@tiptap/vue-3';
import StarterKit from '@tiptap/starter-kit';
import {
    Bold,
    Italic,
    Underline,
    Heading1,
    Heading2,
    List,
    ListOrdered,
    Code,
    Quote,
    SquareMinus,
    Undo,
    Redo
} from 'lucide-vue-next';
import { Button } from '@/components/ui/button';
import ToolbarButton from '@/components/Wysiwyg/ToolbarButton.vue';

const editor = useEditor({
    content: '<p>I\'m running Tiptap with Vue.js. 🎉</p>',
    extensions: [
        StarterKit
    ],
    editorProps: {
        attributes: {
            class: 'border border-gray-400 p-4 min-h-[12rem] max-h-[14rem] overflow-auto outline-none prose prose-slate dark:prose-invert max-w-none'
        }
    }
});
</script>

<template>
    <div class="container mx-auto my-8">
        <section v-if="editor"
                 class="felx items-center flex-wrap gap-x-4 border-t border-r border-l border-gray-400 p-4">
            <ToolbarButton :editor="editor" type="bold" command="toggleBold">
                <Bold />
            </ToolbarButton>

            <ToolbarButton :editor="editor" type="italic" command="toggleItalic">
                <Italic />
            </ToolbarButton>

            <ToolbarButton :editor="editor" type="underline" command="toggleUnderline">
                <Underline />
            </ToolbarButton>

            <ToolbarButton :editor="editor" type="heading" command="toggleHeading" :args="{level: 1}">
                <Heading1 />
            </ToolbarButton>

            <ToolbarButton :editor="editor" type="heading" command="toggleHeading" :args="{level: 2}">
                <Heading2 />
            </ToolbarButton>

            <ToolbarButton :editor="editor" type="bulletList" command="toggleBulletList">
                <List />
            </ToolbarButton>

            <ToolbarButton :editor="editor" type="orderList" command="toggleOrderedList">
                <ListOrdered />
            </ToolbarButton>

            <ToolbarButton :editor="editor" type="codeBlock" command="toggleCodeBlock">
                <Code />
            </ToolbarButton>

            <ToolbarButton :editor="editor" type="blockquote" command="toggleBlockquote">
                <Quote />
            </ToolbarButton>

            <ToolbarButton :editor="editor" command="setHorizontalRule">
                <SquareMinus />
            </ToolbarButton>

            <ToolbarButton :editor="editor" command="undo">
                <Undo />
            </ToolbarButton>

            <ToolbarButton :editor="editor" command="redo">
                <Redo />
            </ToolbarButton>
        </section>
        <EditorContent :editor="editor" />
    </div>
</template>

<style scoped>
@reference "tailwindcss";

:deep(.tiptap pre) {
    @apply dark:bg-gray-100 dark:text-gray-900 bg-gray-700 text-gray-100
}

:deep(.tiptap li p) {
    @apply m-0
}
</style>
