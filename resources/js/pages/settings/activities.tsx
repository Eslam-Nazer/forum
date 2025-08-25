import AppLayout from '@/layouts/app-layout';
import SettingsLayout from '@/layouts/settings/layout';
import { BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/react';
import { Props } from '@headlessui/react/dist/types';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Activities',
        href: '/settings/activities',
    },
];

export default function Threads({ activities, user }: Props) {
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title={'Threads Settings'} />
            <SettingsLayout>
                <div className="mt-2">
                    {activities?.map((activity: any) => (
                        <div key={activity.id}>
                            <div className={"m-2"}>{user.name}: {activity.type.split("_").join(" ")} at {new Date(activity.created_at).toLocaleString()}</div>
                            <hr />
                        </div>
                    ))}
                </div>
            </SettingsLayout>
        </AppLayout>
    );
}
