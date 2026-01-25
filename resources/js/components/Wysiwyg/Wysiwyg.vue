<script setup lang="ts">
import { useEditor, EditorContent, VueRenderer, DOMOutputSpecArray } from '@tiptap/vue-3';
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
import ToolbarButton from '@/components/Wysiwyg/ToolbarButton.vue';
import Mention, { MentionNodeAttrs, MentionOptions } from '@tiptap/extension-mention';
import tippy, { Instance as TippyInstance } from 'tippy.js';
import MentionList from '@/components/Wysiwyg/MentionList.vue';
import { SuggestionOptions } from '@tiptap/suggestion';

const props = defineProps<{
    modelValue: string,
}>();

const emit = defineEmits(['update:modelValue']);

const editor = useEditor({
    content: props.modelValue,
    onUpdate: ({ editor }) => {
        emit('update:modelValue', editor.getHTML());
    },
    extensions: [
        StarterKit,
        Mention.configure({
            HTMLAttributes: {
                class: 'mention'
            },
            renderHTML: (props: {
                options: MentionOptions<any, MentionNodeAttrs>;
                node: Node;
                suggestion: SuggestionOptions<any, any> | null;
            }) => {
                return [
                    'a',
                    {
                        // Add HTML attributes here
                        class: 'mention-link',
                        href: `/profile/${props.node.attrs.id}`, // Example: link to user profile
                        'data-id': props.node.attrs.id
                    },
                    `${props.options.suggestion.char}${props.node.attrs.label ?? props.node.attrs.id}`
                ];
            },
            suggestion: {
                items: ({ query }) => {
                    return [
                        'Lea Thompson', 'Cyndi Lauper', 'Tom Cruise'
                    ].filter(item => item.toLowerCase().startsWith(query.toLowerCase())).slice(0, 5);
                },
                char: '@',
                render: () => {
                    let component: VueRenderer;
                    let popup: TippyInstance[];

                    return {
                        onStart: props => {
                            component = new VueRenderer(MentionList, {
                                props,
                                editor: props.editor
                            });

                            if (!props.clientRect) return;

                            popup = tippy('body', {
                                getReferenceClientRect: props.clientRect as any,
                                appendTo: () => document.body,
                                content: component.element,
                                showOnCreate: true,
                                interactive: true,
                                trigger: 'manual',
                                placement: 'bottom-start'
                            });
                        },

                        onUpdate: props => {
                            component.updateProps(props);

                            if (!props.clientRect) return;

                            popup[0].setProps({
                                getReferenceClientRect: props.clientRect as any
                            });
                        },

                        onKeyDown: props => {
                            if (props.event.key === 'Escape') {
                                popup[0].hide();
                                return true;
                            }
                            // Calls the onKeyDown we exposed in MentionList.vue
                            return (component.ref as any)?.onKeyDown(props);
                        },

                        onExit: () => {
                            popup[0].destroy();
                            component.destroy();
                        }
                    };
                }
            }
        })
    ],
    editorProps: {
        attributes: {
            class: 'p-4 min-h-[12rem] max-h-[14rem] overflow-auto outline-none prose prose-slate dark:prose-invert max-w-none'
        }
    }
});
</script>

<template>
    <div class="container mx-auto my-8 rounded-lg border">
        <section
            v-if="editor"
            class="flex items-center justify-between p-4 border-b"
        >
            <div class="space-x-2">
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
            </div>

            <div class="space-x-3">
                <ToolbarButton :editor="editor" command="undo">
                    <Undo />
                </ToolbarButton>

                <ToolbarButton :editor="editor" command="redo">
                    <Redo />
                </ToolbarButton>
            </div>
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
