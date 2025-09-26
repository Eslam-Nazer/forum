<script setup lang="ts">
import TextLink from '@/components/TextLink.vue';
import Select from '@/components/ui/select/Select.vue';
import SelectContent from '@/components/ui/select/SelectContent.vue';
import SelectItem from '@/components/ui/select/SelectItem.vue';
import SelectTrigger from '@/components/ui/select/SelectTrigger.vue';
import SelectValue from '@/components/ui/select/SelectValue.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import favorite from '@/routes/favorite';
import threads from '@/routes/threads';
import { type BreadcrumbItem } from '@/types';
import { Head, router } from '@inertiajs/vue3';
import dayjs from 'dayjs';
import { computed, Ref, ref } from 'vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Threads',
        href: threads.index().url,
    },
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
}

const props = defineProps<{
    channels: Channel[];
    Threads: {
        data: Thread[];
        links: any[];
        prev_page_url: string;
        next_page_url: string;
    };
    slug?: string;
}>();

const selectChannel = ref(props.slug ?? null);

function onChangeChannel(slug?: Ref<string | null>): void {
    if (slug) {
        router.visit(threads.index().url + '/' + slug);
    } else {
        router.visit(threads.index().url);
    }
}

const numericLinks = computed(() => {
    const links = props.Threads.links.filter(
        (link: any) => !isNaN(Number(link.label)),
    );
    const currentLink = links.find((link: any) => link.active);

    if (!currentLink) return links; // Handle case where no active link is found

    const current = Number(currentLink.label);
    const totalPages = links.length;
    const pages = [];

    // If we have 10 or fewer pages, show all pages
    if (totalPages <= 10) return links;

    // Always include the first page
    pages.push(links[0]);

    if (current <= 4) {
        // Show pages 1-5, then ellipsis, then last page
        pages.push(...links.slice(1, 5));
        if (totalPages > 6) {
            pages.push({ label: '...', url: null, active: false });
            pages.push(links[links.length - 1]);
        }
    } else if (current >= totalPages - 3) {
        // Show first page, ellipsis, then last 5 pages
        if (totalPages > 6) {
            pages.push({ label: '...', url: null, active: false });
        }
        pages.push(...links.slice(totalPages - 5, totalPages));
    } else {
        // Show first page, ellipsis, current page ±2, ellipsis, last page
        pages.push({ label: '...', url: null, active: false });
        pages.push(...links.slice(current - 3, current + 2));
        pages.push({ label: '...', url: null, active: false });
        pages.push(links[links.length - 1]);
    }

    // Remove duplicates that might occur at boundaries
    const uniquePages = [];
    const seenLabels = new Set();

    for (const page of pages) {
        if (!seenLabels.has(page.label)) {
            uniquePages.push(page);
            seenLabels.add(page.label);
        }
    }

    return uniquePages;
});
</script>

<template>
    <Head title="Threads" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="mx-auto mt-4 max-w-4xl">
            <div class="flex w-3/4 justify-between">
                <div>
                    <TextLink
                        :href="threads.create()"
                        type="button"
                        class="me-2 mb-2 cursor-pointer rounded-lg bg-blue-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 focus:outline-none dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        :class="['!no-underline']"
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
            <div
                v-for="thread in Threads.data"
                class="my-4 w-3/4 rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800"
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
                        class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white"
                    >
                        {{ thread.title }}
                    </h5>

                    <div class="flex flex-col items-center justify-center">
                        <TextLink
                            :href="
                                favorite.store({
                                    type: 'threads',
                                    id: thread.id,
                                })
                            "
                            :method="'post'"
                            :class="{
                                'text-red-400': thread.is_favorite,
                            }"
                            class="cursor-pointer"
                            preserve-scroll
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                                fill="currentColor"
                                class="size-6"
                            >
                                <path
                                    d="m11.645 20.91-.007-.003-.022-.012a15.247 15.247 0 0 1-.383-.218 25.18 25.18 0 0 1-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0 1 12 5.052 5.5 5.5 0 0 1 16.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 0 1-4.244 3.17 15.247 15.247 0 0 1-.383.219l-.022.012-.007.004-.003.001a.752.752 0 0 1-.704 0l-.003-.001Z"
                                />
                            </svg>
                        </TextLink>
                        <span>{{ thread.favorites_count }}</span>
                    </div>
                </div>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                    {{ thread.body }}
                </p>
                <a
                    href="#"
                    class="inline-flex items-center rounded-lg bg-blue-700 px-3 py-2 text-center text-sm font-medium text-white hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 focus:outline-none dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
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
                </a>
            </div>

            <nav class="content-end-safe" aria-label="Page navigation example">
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
            </nav>
        </div>
    </AppLayout>
</template>

<style scoped></style>
