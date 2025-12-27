<script setup lang="ts">

import { Button } from '@/components/ui/button';
import { Lock, LockOpen } from 'lucide-vue-next';
import { Auth, Thread } from '@/types';

const props = defineProps<{
    thread?: Thread;
    auth?: Auth;
}>();
</script>

<template>
    <Button href="#" variant="secondary">
        <LockOpen />
        Unlock
    </Button>
    <Button>
        <Lock />
        Lock
    </Button>
</template>

<style scoped>
lock-thread {

}
</style>
