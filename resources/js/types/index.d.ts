import { InertiaLinkProps } from '@inertiajs/vue3';
import type { LucideIcon } from 'lucide-vue-next';

export interface Auth {
    user: User;
}

export interface BreadcrumbItem {
    title: string;
    href: string;
}

export interface NavItem {
    title: string;
    href: NonNullable<InertiaLinkProps['href']>;
    icon?: LucideIcon;
    isActive?: boolean;
}

export type AppPageProps<
    T extends Record<string, unknown> = Record<string, unknown>,
> = T & {
    name: string;
    quote: { message: string; author: string };
    auth: Auth;
    sidebarOpen: boolean;
};

export interface User {
    id: number;
    name: string;
    email: string;
    avatar?: string;
    email_verified_at: string | null;
    created_at: string;
    updated_at: string;
    avatar_path: string;
}

export interface Thread {
    id: string;
    title: string;
    body: string;
    user_id: number;
    locked: boolean;
    slug: string;
    created_at: string;
    channel: Channel;
    creator: {
        id: number;
        name: string;
    };
    is_favorite: boolean;
    is_subscribed: bolean;
    replies_count: number;
    favorites_count: number;
    last_page: number;
    has_updates_for: boolean;
    visits_count?: number;
    can?: array;
}

export interface Channel {
    id: string;
    name: string;
    slug: string;
}

export interface Trending {
    title: string;
    slug: string;
    path: string;
}


export type BreadcrumbItemType = BreadcrumbItem;
