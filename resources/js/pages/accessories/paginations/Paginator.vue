<script setup lang="ts">
import TextLink from '@/components/TextLink.vue';
import Pagination from '@/components/ui/pagination/Pagination.vue';
import PaginationContent from '@/components/ui/pagination/PaginationContent.vue';
import PaginationItem from '@/components/ui/pagination/PaginationItem.vue';
import PaginationNext from '@/components/ui/pagination/PaginationNext.vue';
import PaginationPrevious from '@/components/ui/pagination/PaginationPrevious.vue';
import { cn } from '@/lib/utils';
import { ChevronLeftIcon, ChevronRightIcon } from 'lucide-vue-next';
import { markRaw } from 'vue';

interface PaginationLinks {
    url?: string;
    label: string;
    active?: boolean;
}

const props = defineProps<{
    links: PaginationLinks[];
    currentPage?: number;
    perPage: number;
    total: number;
    nextPageUrl?: string;
    prevPageUrl?: string;
    lastPage: number;
}>();

const TextLinkComponent = markRaw(TextLink);
let links = props.links.slice(1, props.links.length - 1);
</script>

<template>
    <Pagination
        v-if="lastPage > 1"
        :page="currentPage"
        :itemsPerPage="10"
        :total="30"
        :defaultPage="2"
        :class="cn('my-3')"
    >
        <PaginationContent>
            <PaginationPrevious :disabled="!prevPageUrl" asChild>
                <Component
                    :href="prevPageUrl"
                    :is="prevPageUrl ? TextLink : 'span'"
                    class="flex items-center gap-1 !no-underline"
                >
                    <ChevronLeftIcon />
                    <span class="hidden sm:block">Previous</span>
                </Component>
            </PaginationPrevious>

            <template v-for="(link, index) in links" :key="index">
                <PaginationItem
                    :value="0"
                    :isActive="link.active"
                    :as="
                        !isNaN(Number(link.label)) ? TextLinkComponent : 'span'
                    "
                    :href="link.url"
                    :class="
                        cn(
                            '!no-underline',
                            isNaN(Number(link.label)) && 'cursor-not-allowed',
                        )
                    "
                >
                    {{ link.label }}
                </PaginationItem>
            </template>

            <PaginationNext :disabled="!nextPageUrl" asChild>
                <Component
                    :is="nextPageUrl ? TextLink : 'span'"
                    :href="nextPageUrl"
                    class="flex items-center gap-1 !no-underline"
                >
                    <span class="hidden sm:block">Next</span>
                    <ChevronRightIcon />
                </Component>
            </PaginationNext>
        </PaginationContent>
    </Pagination>
</template>
