import AppLayout from '@/layouts/app-layout';
import SettingsLayout from '@/layouts/settings/layout';
import { BreadcrumbItem } from '@/types';
import { Props } from '@headlessui/react/dist/types';
import { Head } from '@inertiajs/react';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Threads',
        href: '/settings/threads',
    },
];

export default function Threads({ threads }: Props) {
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title={'Threads Settings'} />
            <SettingsLayout>
                <div className="mt-2">
                    hi
                    {threads.map((thread: any) => (
                        <div>
                            <div>{thread.title}</div>
                            <div>{thread.body}</div>
                            <div>replies count {thread.replies_count}</div>
                        </div>
                    ))}
                </div>
            </SettingsLayout>
        </AppLayout>
    );
}
