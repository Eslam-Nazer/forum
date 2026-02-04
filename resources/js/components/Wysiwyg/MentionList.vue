<script setup lang="ts">

import { ref } from 'vue';
import { ScrollArea } from '@/components/ui/scroll-area';
import { Button } from '@/components/ui/button';
import { Separator } from '@/components/ui/separator';

interface Props {
    items: any,
    command: (props: { id: number | string, label: string }) => void
}

const props = defineProps<Props>();
const selectIndex = ref(0);

const selectItem = (index: number) => {
    const item: any = props.items[index];

    if (item) {
        props.command({ id: item.slug, label: item.name });
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
    <ScrollArea class="rounded-md border w-52 h-40 px-3">
        <div class="">
            <h4 class="m-3 text-center leading-none font-medium">
                Users
            </h4>
            <Separator class="mb-2 font-semibold" />

            <template
                v-for="(item, index) in items"
                :key="index"
            >

                <Button
                    :variant="index === selectIndex ? 'default' : 'ghost'"
                    class="ml-2"
                    @click="selectItem(index)"
                >
<!--                    <UserAvatar :user="item" size="sm" class="my-2" />-->
                    {{ item.name.slice(0, 18) }}
                </Button>

                <Separator class="my-2 last:hidden" />
            </template>
        </div>
    </ScrollArea>
</template>

<style scoped>
</style>
