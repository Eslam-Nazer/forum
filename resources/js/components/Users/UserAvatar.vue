<script setup lang="ts">

import { cn } from '@/lib/utils';
import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar';
import { User } from '@/types';
import { useInitials } from '@/composables/useInitials';
import { computed } from 'vue';

interface Props {
    user: User;
    size: 'sm' | 'base' | 'lg' | null | undefined;
}

const props = withDefaults(defineProps<Props>(), {
    size: 'base'
});

const { getInitials } = useInitials();

const showAvatar = computed(
    () => props.user.avatar_path && props.user.avatar_path !== ''
);

</script>

<template>
    <Avatar :size="size">
        <AvatarImage v-if="showAvatar" :src="user.avatar_path" :alt="user.name" />
        <AvatarFallback>
            <div :class="cn('text-5xl', 'text-center')">
                {{ getInitials(user.name) }}
            </div>
        </AvatarFallback>
    </Avatar>
</template>

<style scoped>

</style>
