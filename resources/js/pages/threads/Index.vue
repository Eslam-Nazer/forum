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
import { type BreadcrumbItem, Thread, Trending } from '@/types';
import { FireIcon } from '@heroicons/vue/20/solid';
import { Head, router } from '@inertiajs/vue3';
import dayjs from 'dayjs';
import { MessageCircleOff } from 'lucide-vue-next';
import { markRaw, Ref, ref } from 'vue';
import Paginator from '../accessories/paginations/Paginator.vue';
import FavoriteButton from '../favorites/FavoriteButton.vue';
import HeadingSmall from '@/components/HeadingSmall.vue';
import { Badge } from '@/components/ui/badge';

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
        last_page: number;
    };
    slug?: string;
    trending: Trending[]
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

        <div class="flex gap-2 mx-4">
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
                    class="my-4 w-full rounded-lg border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800"
                    :key="thread.id"
                >
                    <div class="p-6">
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
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M1 5h12m0 0L9 1m4 4L9 9"
                                />
                            </svg>
                        </TextLink>
                    </div>
                    <div>
                        <hr class="dark:border-gray-600 border-gray-400" />
                        <div class="px-6 py-3 text-lg font-semibold">{{ thread.visits }} visits</div>
                    </div>
                </div>

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

            <div class="mx-auto mt-4 w-full max-w-md">
                <HeadingSmall title="Trending" />
                <Card :class="cn('p-5')">
                    <Card
                        v-if="trending.length != 0"
                        v-for="(thread, index) in trending"
                        :class="cn('gap-2 py-5')"
                    >
                        <div class="pl-3">
                            <Badge class="font-semibold font-mono block mb-2">{{ thread.slug }}</Badge>
                            <TextLink class="font-semibold" :href="thread.path">{{ thread.title }}</TextLink>
                        </div>
                        <div v-if="index==0">
                            <hr class="my-2" />
                            <div class="pl-3">
                                <Badge>🔥 Hot</Badge>
                            </div>
                        </div>

                    </Card>
                    <div v-else :class="cn('text-center')">No trending threads yet.</div>
                </Card>
            </div>
        </div>
    </AppLayout>
</template>

<style scoped></style>
