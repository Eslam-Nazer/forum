<script setup lang="ts">

import AppLayout from '@/layouts/AppLayout.vue';
import { BreadcrumbItem } from '@/types';
import { index } from '@/routes/settings/threads';
import { Head } from '@inertiajs/vue3';
import SettingsLayout from '@/layouts/settings/Layout.vue';
import HeadingSmall from '@/components/HeadingSmall.vue';
import TextLink from '@/components/TextLink.vue';
import { show } from '@/routes/threads';
import { formatDate, shorten } from '@/lib/utils';

const breadcrumbItems: BreadcrumbItem[] = [
    {
        title: 'User threads settings',
        href: index().url
    }
];

const props = defineProps<{
    threads: any[];
}>();
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbItems">
        <Head title="User threads settings" />
        <SettingsLayout>
            <div class="space-y-6">
                <HeadingSmall
                    title="User threads settings"
                    description="You can show all your own threads here."
                />
                <div class="text-lg font-semibold">
                    <div
                        class="pl-2"
                        v-if="threads.length !== 0"
                        v-for="thread in threads"
                        :key="thread.id"
                    >
                        <TextLink
                            :href="show({ channel: thread.channel.slug, id: thread.id }).url"
                        >
                            {{ shorten(thread.title, 20) }}
                            posted at {{ formatDate(thread.created_at) }}
                        </TextLink>
                    </div>

                    <div class="text-" v-else>
                        You have not posted any threads.
                    </div>
                </div>
            </div>
        </SettingsLayout>
    </AppLayout>
</template>

<style scoped>

</style>
