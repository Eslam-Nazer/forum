<script setup lang="ts">

import { ref } from 'vue';

interface Props {
    items: string[],
    command: (props: { id: number | string }) => void
}

const props = defineProps<Props>();
const selectIndex = ref(0);

const selectItem = (index: number) => {
    const item: any = props.items[index];

    if (item) {
        props.command({ id: item });
    }
};

defineExpose({
    onKeyDown: ({ event }: { event: KeyboardEvent }) => {
        if (event.key === 'ArrowUp') {
            selectIndex.value = ((selectIndex.value + props.items.length - 1) % props.items.length);
            return true;
        }

        if (event.key === 'ArrowDown') {
            selectIndex.value = ((selectIndex.value + 1) % props.items.length);
            return true;
        }

        if (event.key === 'Enter') {
            selectItem(selectIndex.value);
            return true;
        }

        return false;
    }
});
</script>

<template>
    <div class="mention-list-dropdown ">
        <button
            v-for="(item, index) in items"
            :key="index"
            :class="{ 'is-selected': index === selectIndex }"
            @click="selectItem(index)"
        >
            {{ item }}
        </button>
    </div>
</template>

<style scoped>
.mention-list-dropdown {
    background: gray;
    border: 1px solid #ccc;
    border-radius: 0.5rem;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    display: flex;
    flex-direction: column;
}

.is-selected {
    background: #c9c3c3;
}

button {
    text-align: left;
    padding: 0.5rem 1rem;
    border: none;
    background: transparent;
    cursor: pointer;
}
</style>
