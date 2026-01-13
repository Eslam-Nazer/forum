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
            <Button
                variant="outline"
                @click="editor.chain().focus().toggleBold().run()"
                :disabled="!editor.can().chain().focus().toggleBold().run()"
                :class="{ 'bg-gray-200 dark:bg-gray-700': editor.isActive('bold') }"
                class="p-1 rounded"
            >
                <Bold />
            </Button>
            <Button
                variant="outline"
                @click="editor.chain().focus().toggleItalic().run()"
                :disabled="!editor.can().chain().focus().toggleItalic().run()"
                :class="{ 'bg-gray-200 dark:bg-gray-700': editor.isActive('italic') }"
                class="p-1 rounded"
            >
                <Italic />
            </Button>
            <Button
                variant="outline"
                @click="editor.chain().focus().toggleUnderline().run()"
                :disabled="!editor.can().chain().focus().toggleUnderline().run()"
                :class="{ 'bg-gray-200 dark:bg-gray-700': editor.isActive('underline') }"
                class="p-1 rounded"
            >
                <Underline />
            </Button>
            <Button
                variant="outline"
                @click="editor.chain().focus().toggleHeading({level: 1}).run()"
                :disabled="!editor.can().chain().focus().toggleHeading({level: 1}).run()"
                :class="{ 'bg-gray-200 dark:bg-gray-700': editor.isActive('heading', {level: 1}) }"
                class="p-1 rounded"
            >
                <Heading1 />
            </Button>
            <Button
                variant="outline"
                @click="editor.chain().focus().toggleHeading({level: 2}).run()"
                :disabled="!editor.can().chain().focus().toggleHeading({level: 2}).run()"
                :class="{ 'bg-gray-200 dark:bg-gray-700': editor.isActive('heading', {level: 2}) }"
                class="p-1 rounded"
            >
                <Heading2 />
            </Button>
            <Button
                variant="outline"
                @click="editor.chain().focus().toggleBulletList().run()"
                :disabled="!editor.can().chain().focus().toggleBulletList().run()"
                :class="{ 'bg-gray-200 dark:bg-gray-700': editor.isActive('bulletList') }"
                class="p-1 rounded"
            >
                <List />
            </Button>
            <Button
                variant="outline"
                @click="editor.chain().focus().toggleOrderedList().run()"
                :disabled="!editor.can().chain().focus().toggleOrderedList().run()"
                :class="{ 'bg-gray-200 dark:bg-gray-700': editor.isActive('orderList') }"
                class="p-1 rounded"
            >
                <ListOrdered />
            </Button>
            <Button
                variant="outline"
                @click="editor.chain().focus().toggleCodeBlock().run()"
                :disabled="!editor.can().chain().focus().toggleCodeBlock().run()"
                :class="{ 'bg-gray-200 dark:bg-gray-700': editor.isActive('codeBlock') }"
                class="p-1 rounded"
            >
                <Code />
            </Button>
            <Button
                variant="outline"
                @click="editor.chain().focus().toggleBlockquote().run()"
                :disabled="!editor.can().chain().focus().toggleBlockquote().run()"
                :class="{ 'bg-gray-200 dark:bg-gray-700': editor.isActive('blockquote') }"
                class="p-1 rounded"
            >
                <Quote />
            </Button>
            <Button
                variant="outline"
                @click="editor.chain().focus().setHorizontalRule().run()"
                :disabled="!editor.can().chain().focus().setHorizontalRule().run()"
                class="p-1"
            >
                <SquareMinus />
            </Button>
            <Button
                variant="outline"
                @click="editor.chain().focus().undo().run()"
                :disabled="!editor.can().chain().focus().undo().run()"
                class="p-1 disabled:text-gray-400"
            >
                <Undo />
            </Button>
            <Button
                variant="outline"
                @click="editor.chain().focus().redo().run()"
                :disabled="!editor.can().chain().focus().redo().run()"
                class="p-1 disabled:text-gray-400"
            >
                <Redo />
            </Button>
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
