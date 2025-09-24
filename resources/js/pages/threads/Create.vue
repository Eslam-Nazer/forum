<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import { Card } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import Label from '@/components/ui/label/Label.vue';
import Select from '@/components/ui/select/Select.vue';
import SelectContent from '@/components/ui/select/SelectContent.vue';
import SelectItem from '@/components/ui/select/SelectItem.vue';
import SelectLabel from '@/components/ui/select/SelectLabel.vue';
import SelectTrigger from '@/components/ui/select/SelectTrigger.vue';
import SelectValue from '@/components/ui/select/SelectValue.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import threads from '@/routes/threads';
import { BreadcrumbItem } from '@/types';
import { Head, useForm } from '@inertiajs/vue3';
import { defineProps } from 'vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Create Thread',
        href: threads.create().url,
    },
];

interface Channel {
    id: string;
    name: string;
    slug: string;
};

defineProps<{
    channels: Channel[]
}>();

const form = useForm({
    title: '',
    body: '',
    channel_id: '',
});

function submit() {
    form.post(threads.store().url);
}
</script>

<template>
    <Head title="Create Thread" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="mx-auto w-full max-w-4xl">
            <Card class="mt-5 pl-6">
                <h2 class="text-3xl">Create Thread</h2>
                <form @submit.prevent="submit">
                    <div class="w-full max-w-xl">
                        <Label for="title" class="text-lg font-bold">Title</Label>
                        <Input v-model="form.title" id="title" />
                        <InputError class="!text-md" :message="$page.props.errors.title" />

                        <Select v-model="form.channel_id">
                            <SelectTrigger class="mt-5 w-full">
                                <SelectValue placeholder="Select a channel" />
                            </SelectTrigger>
                            <SelectContent>
                                <SelectLabel>Select a channel</SelectLabel>
                                <SelectItem v-for="channel in channels" :key="channel.id" :value="channel.id"> {{ channel.name }} </SelectItem>
                            </SelectContent>
                        </Select>
                        <InputError class="!text-md" :message="$page.props.errors.channel_id" />

                        <Label for="body" class="mt-5 block text-lg font-bold text-gray-900 dark:text-white"> Body </Label>
                        <textarea
                            v-model="form.body"
                            id="body"
                            rows="4"
                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-gray-500 focus:ring-gray-500 dark:border-[#262626] dark:bg-black dark:text-white dark:placeholder-gray-400 dark:focus:border-gray-500 dark:focus:ring-gray-500"
                            placeholder="Write your thoughts here..."
                        ></textarea>
                        <InputError class="!text-md" :message="$page.props.errors.body" />
                        <button
                            type="submit"
                            class="my-5 me-2 mb-2 rounded-lg bg-blue-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 focus:outline-none dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        >
                            Save
                        </button>
                    </div>
                </form>
            </Card>
        </div>
    </AppLayout>
</template>
