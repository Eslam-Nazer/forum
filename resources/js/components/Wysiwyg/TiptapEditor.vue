<script setup lang="ts">
import { useEditor, EditorContent, VueRenderer } from '@tiptap/vue-3';
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
import { onMounted, Ref, ref, watch } from 'vue';
import axios from 'axios';
import mentions from '@/routes/mentions';
import { User } from '@/types';

interface editorProps {
    modelValue: string,
}

interface editorEmits {
    (e: 'update:modelValue', value: string): void;
}

const props = defineProps<editorProps>();
const emit = defineEmits<editorEmits>();
const users: Ref<User[]> = ref([]);

const loadUsers = async (): Promise<void> => {
    try {
        const response = await axios.get<User[]>(mentions.index().url);
        users.value = response.data;
    } catch (error) {
        console.error('Failed to load users for mentions:', error);

        if (axios.isAxiosError(error)) {
            console.error('Axios error details:', {
                message: error.message,
                status: error.response?.status,
                url: error.config?.url
            });
        } else {
            console.error('Unexpected error type:', error instanceof Error ? error.message : String(error));
        }
    }
};

onMounted(loadUsers);

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
            renderHTML: ({ options, node }) => {
                return [
                    'a',
                    {
                        class: 'mention-link',
                        href: `/${node.attrs.id}/profile`,
                        'data-id': node.attrs.id
                    },
                    `${options.suggestion.char}${node.attrs.label}`
                ];
            },
            suggestion: {
                items: ({ query }): User[] => {
                    return users.value
                        .filter((user: User) =>
                            user.name.toLowerCase().startsWith(query.toLowerCase())
                        )
                        .slice(0, 10);
                },
                char: '@',
                render: () => {
                    let component: VueRenderer;
                    let popup: TippyInstance;

                    return {
                        onStart: (props): void => {
                            component = new VueRenderer(MentionList, {
                                props,
                                editor: props.editor
                            });

                            if (!props.clientRect) return;

                            popup = tippy(document.body as Element | HTMLElement, {
                                getReferenceClientRect: props.clientRect as any,
                                appendTo: () => document.body,
                                content: component.element,
                                showOnCreate: true,
                                interactive: true,
                                trigger: 'manual',
                                placement: 'bottom-start'
                            });
                        },

                        onUpdate: (props): void => {
                            component.updateProps(props);

                            if (!props.clientRect) return;

                            popup.setProps({
                                getReferenceClientRect: props.clientRect as any
                            });
                        },

                        onKeyDown: (props): boolean => {
                            if (props.event.key === 'Escape') {
                                popup.hide();
                                return true;
                            }
                            return (component.ref as any)?.onKeyDown(props);
                        },

                        onExit: (): void => {
                            popup.destroy();
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

// Watch for external changes to modelValue and update editor content
watch(() => props.modelValue, (newValue) => {
    if (editor.value && editor.value.getHTML() !== newValue) {
        editor.value.commands.setContent(newValue);
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
