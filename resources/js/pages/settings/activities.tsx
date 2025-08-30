import AppLayout from '@/layouts/app-layout';
import SettingsLayout from '@/layouts/settings/layout';
import { BreadcrumbItem } from '@/types';
import { Props } from '@headlessui/react/dist/types';
import { Head } from '@inertiajs/react';

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
                    {Object.entries(activities).map(([date, activity]) => (
                        <div>
                            <h3 className={'m-2'}>{date}</h3>
                            <hr className={"border-gray-300"}/>
                            <div>
                                {activity.map((record: any) => (
                                    <div>{user.name}: {record.type.split('_').join(' ')}</div>
                                ))}
                            </div>
                        </div>
                    ))}
                </div>
            </SettingsLayout>
        </AppLayout>
    );
}
