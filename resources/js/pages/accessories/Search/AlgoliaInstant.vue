<script setup lang="ts">

import { liteClient as algoliasearch } from 'algoliasearch/lite';
import { Input } from '@/components/ui/input';

const searchClient = algoliasearch(
    import.meta.env.VITE_ALGOLIA_APP_ID,
    import.meta.env.VITE_ALGOLIA_API_KEY
);

</script>

<template>
    <ais-instant-search :search-client="searchClient" index-name="threads">
        <ais-search-box>
            <template
                #default="{currentRefinement, refine}"
            >
                <Input
                    :modelValue="currentRefinement"
                    @update:modelValue="refine"
                />
            </template>
        </ais-search-box>
        <ais-hits>
            <template #item="{ item }">
                <h2>
                    <ais-highlight attribute="title" :hit="item">
                        {{ item.title }}
                    </ais-highlight>
                </h2>
            </template>
        </ais-hits>
    </ais-instant-search>
</template>

<style scoped>

</style>
