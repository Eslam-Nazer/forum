<script setup lang="ts">

import AppLayout from '@/layouts/AppLayout.vue';
import { Auth, BreadcrumbItem } from '@/types';
import { index } from '@/routes/settings/avatar';
import SettingsLayout from '@/layouts/settings/Layout.vue';
import { Form, Head } from '@inertiajs/vue3';
import HeadingSmall from '@/components/HeadingSmall.vue';
import { Label } from '@/components/ui/label';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import AvatarController from '@/actions/Modules/Forum/Http/Controllers/Api/V1/AvatarController';
import UserAvatar from '@/components/Users/UserAvatar.vue';

const breadcrumbItems: BreadcrumbItem[] = [
    {
        title: 'User Avatar',
        href: index().url
    }
];

const props = defineProps<{
    auth: Auth
}>();
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbItems">
        <Head title="Avatar" />
        <SettingsLayout>
            <div class="space-y-4">
                <HeadingSmall
                    title="Avatar"
                    description="You can upload new image to make as avatar"
                />
                <div class="">
                    <div class="col-span-full">
                        <Label for="photo" class="block text-sm/6 font-medium text-white">Photo</Label>
                        <div class="mt-2 flex items-center gap-x-3">
                            <div>
                                <UserAvatar :user="auth.user" size="base" />
                                <div>
                                    <h3 class="text-center text-base/7 font-semibold tracking-tight text-white">
                                        {{ auth.user.name }}
                                    </h3>
                                </div>
                            </div>
                            <Form
                                v-bind="AvatarController.store.form(auth.user.id)"
                                #default="{ errors }"
                            >
                                <Button :as="'input'" name="avatar" :type="'file'" variant="secondary" />
                                <Button
                                    type="submit"
                                    variant="secondary"
                                    class="mt-2 ml-2"
                                >
                                    Change
                                </Button>
                                <InputError :message="errors.avatar" />
                            </Form>
                        </div>
                    </div>
                </div>
            </div>
        </SettingsLayout>
    </AppLayout>
</template>

<style scoped>

</style>
