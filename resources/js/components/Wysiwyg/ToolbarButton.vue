<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Editor } from '@tiptap/vue-3';
import { computed } from 'vue';

const props = withDefaults(defineProps<{
    editor: Editor,
    type?: string,
    command: string,
    args?: Object
}>(), {
    type: ''
});

const isActive = computed(() =>
    props.editor.isActive(props.type, props.args)
);

const canExecute = computed(() => {
    const chain = props.editor.can().chain().focus() as any;
    return chain[props.command](props.args).run();
});
</script>

<template>
    <Button
        :variant="isActive && type ? 'default' : 'outline'"
        size="icon"
        @click="(editor.chain().focus() as any)[command](args).run()"
        :disabled="!canExecute"
        type="button"
    >
        <slot />
    </Button>
</template>
