<script setup lang="ts">
import TextLink from '@/components/TextLink.vue';
import Button from '@/components/ui/button/Button.vue';
import Card from '@/components/ui/card/Card.vue';
import Select from '@/components/ui/select/Select.vue';
import SelectContent from '@/components/ui/select/SelectContent.vue';
import SelectItem from '@/components/ui/select/SelectItem.vue';
import SelectTrigger from '@/components/ui/select/SelectTrigger.vue';
import SelectValue from '@/components/ui/select/SelectValue.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { cn } from '@/lib/utils';
import threads from '@/routes/threads';
import { type BreadcrumbItem } from '@/types';
import { FireIcon } from '@heroicons/vue/20/solid';
import { Head, router } from '@inertiajs/vue3';
import dayjs from 'dayjs';
import { MessageCircleOff } from 'lucide-vue-next';
import { markRaw, Ref, ref } from 'vue';
import Paginator from '../accessories/paginations/Paginator.vue';
import FavoriteButton from '../favorites/FavoriteButton.vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Threads',
        href: threads.index().url
    }
];

interface Channel {
    id: string;
    name: string;
    slug: string;
}

interface Thread {
    id: string;
    title: string;
    body: string;
    slug: string;
    created_at: string;
    channel: Channel;
    creator: {
        id: string;
        name: string;
    };
    is_favorite: boolean;
    replies_count: number;
    favorites_count: number;
    last_page: number;
    has_updates_for: boolean;
}

const props = defineProps<{
    channels: Channel[];
    Threads: {
        data: Thread[];
        links: any[];
        prev_page_url: string;
        next_page_url: string;
        current_page?: number;
        per_page: number;
        total: number;
    };
    slug?: string;
}>();

const selectChannel = ref(props.slug ?? null);
const TextLinkRaw = markRaw(TextLink);

function onChangeChannel(slug?: Ref<string | null>): void {
    if (slug) {
        router.visit(threads.index().url + '/' + slug);
    } else {
        router.visit(threads.index().url);
    }
}
</script>

<template>
    <Head title="Threads" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <template #header-actions>
            <Button
                :class="cn('!no-underline')"
                :as="TextLinkRaw"
                :href="'?unanswered=1'"
            >
                <MessageCircleOff />
            </Button>
            <Button
                :class="cn('!no-underline')"
                :as="TextLinkRaw"
                :href="threads.index().url"
            >
                All Threads
            </Button>
            <Button
                :class="cn('!no-underline')"
                :as="TextLinkRaw"
                :href="'?popular'"
            >
                <FireIcon class="h-5 w-5" />
                Popular
            </Button>
        </template>

        <div class="mx-auto mt-4 w-full max-w-4xl">
            <div class="flex w-full justify-between">
                <div>
                    <TextLink
                        :href="threads.create()"
                        type="button"
                        class="me-2 mb-2 cursor-pointer rounded-lg bg-blue-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 focus:outline-none dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        :class="cn('!no-underline')"
                    >
                        New Thread
                    </TextLink>
                </div>

                <div>
                    <Select
                        v-model="selectChannel"
                        @update:model-value="onChangeChannel"
                    >
                        <SelectTrigger>
                            <SelectValue placeholder="Select Channel" />
                        </SelectTrigger>
                        <SelectContent>
                            <RecycleScroller
                                :items="channels"
                                :item-size="30"
                                key-field="id"
                                v-slot="{ item: channel }"
                            >
                                <SelectItem
                                    :key="channel.id"
                                    :value="channel.slug"
                                >
                                    {{ channel.name }}
                                </SelectItem>
                            </RecycleScroller>
                        </SelectContent>
                    </Select>
                </div>
            </div>
            <Card
                :class="cn('mt-4 w-full p-4 text-center text-lg')"
                v-if="Threads.data.length === 0"
            >
                Threads Not Found
            </Card>
            <div
                v-else
                v-for="thread in Threads.data"
                class="my-4 w-full rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800"
                :key="thread.id"
            >
                <div class="block">
                    Create By: {{ thread.creator.name }} at
                    {{ dayjs(thread.created_at).format('HH:mm YYYY-MM-DD') }}
                </div>
                <div
                    class="mb-2 flex content-center items-center justify-between"
                >
                    <h5
                        :class="cn('text-2xl font-bold tracking-tight',
                         thread.has_updates_for ? 'text-gray-900' : 'text-gray-700',
                           thread.has_updates_for ?  'dark:text-white' : 'dark:text-gray-500')"
                    >
                        {{ thread.title }}
                    </h5>

                    <div class="flex flex-col items-center justify-center">
                        <FavoriteButton :model="thread" :type="'threads'" />
                    </div>
                </div>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                    {{ thread.body }}
                </p>
                <TextLink
                    :href="
                        threads.show({
                            channel: thread.channel.slug,
                            id: thread.id,
                        })
                    "
                    class="inline-flex items-center rounded-lg bg-blue-700 px-3 py-2 text-center text-sm font-medium text-white !no-underline hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 focus:outline-none dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                >
                    Show {{ thread.replies_count }} Replies
                    <svg
                        class="ms-2 h-3.5 w-3.5 rtl:rotate-180"
                        aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 14 10"
                    >
                        <path
                            stroke="currentColor"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M1 5h12m0 0L9 1m4 4L9 9"
                        />
                    </svg>
                </TextLink>
            </div>

            <!-- <nav class="content-end-safe" aria-label="Page navigation example">
                <ul class="inline-flex h-10 -space-x-px text-base">
                    <li>
                        <Component
                            :is="Threads.prev_page_url ? TextLink : 'span'"
                            :href="Threads.prev_page_url"
                            class="ms-0 flex h-10 items-center justify-center rounded-s-lg border border-e-0 border-gray-300 bg-white px-4 leading-tight text-gray-500 !no-underline underline-offset-0 hover:bg-gray-100 hover:text-gray-700 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                        >
                            Previous
                        </Component>
                    </li>
                    <li v-for="link in numericLinks" :key="link.label">
                        <Component
                            :is="link.url ? TextLink : 'span'"
                            :href="link.url"
                            class="flex h-10 items-center justify-center border border-gray-300 bg-white px-4 leading-tight text-gray-500 !no-underline hover:bg-gray-100 hover:text-gray-700 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                            :class="{
                                'bg-blue-50 text-blue-600 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-800 dark:bg-gray-900 dark:text-white':
                                    link.active,
                            }"
                        >
                            {{ link.label }}
                        </Component>
                    </li>
                    <li>
                        <Component
                            :is="Threads.next_page_url ? TextLink : 'span'"
                            :href="Threads.next_page_url"
                            class="flex h-10 items-center justify-center rounded-e-lg border border-gray-300 bg-white px-4 leading-tight text-gray-500 !no-underline hover:bg-gray-100 hover:text-gray-700 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                        >
                            Next
                        </Component>
                    </li>
                </ul>
            </nav> -->

            <Paginator
                :links="Threads.links"
                :currentPage="Threads.current_page"
                :perPage="Threads.per_page"
                :total="Threads.total"
                :nextPageUrl="Threads.next_page_url"
                :prevPageUrl="Threads.prev_page_url"
                :lastPage="Threads.last_page"
            />
        </div>
    </AppLayout>
</template>

<style scoped></style>
