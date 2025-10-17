import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition, applyUrlDefaults } from './../../wayfinder'
/**
* @see \App\Http\Controllers\Settings\NotificationController::index
* @see app/Http/Controllers/Settings/NotificationController.php:13
* @route '/settings/profiles/notifications'
*/
export const index = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

index.definition = {
    methods: ["get","head"],
    url: '/settings/profiles/notifications',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Settings\NotificationController::index
* @see app/Http/Controllers/Settings/NotificationController.php:13
* @route '/settings/profiles/notifications'
*/
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Settings\NotificationController::index
* @see app/Http/Controllers/Settings/NotificationController.php:13
* @route '/settings/profiles/notifications'
*/
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Settings\NotificationController::index
* @see app/Http/Controllers/Settings/NotificationController.php:13
* @route '/settings/profiles/notifications'
*/
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\Settings\NotificationController::index
* @see app/Http/Controllers/Settings/NotificationController.php:13
* @route '/settings/profiles/notifications'
*/
const indexForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: index.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Settings\NotificationController::index
* @see app/Http/Controllers/Settings/NotificationController.php:13
* @route '/settings/profiles/notifications'
*/
indexForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: index.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Settings\NotificationController::index
* @see app/Http/Controllers/Settings/NotificationController.php:13
* @route '/settings/profiles/notifications'
*/
indexForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: index.url({
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'HEAD',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'get',
})

index.form = indexForm

/**
* @see \App\Http\Controllers\Settings\NotificationController::destroy
* @see app/Http/Controllers/Settings/NotificationController.php:18
* @route '/settings/profiles/notifications/{notificationId}'
*/
export const destroy = (args: { notificationId: string | number } | [notificationId: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

destroy.definition = {
    methods: ["delete"],
    url: '/settings/profiles/notifications/{notificationId}',
} satisfies RouteDefinition<["delete"]>

/**
* @see \App\Http\Controllers\Settings\NotificationController::destroy
* @see app/Http/Controllers/Settings/NotificationController.php:18
* @route '/settings/profiles/notifications/{notificationId}'
*/
destroy.url = (args: { notificationId: string | number } | [notificationId: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { notificationId: args }
    }

    if (Array.isArray(args)) {
        args = {
            notificationId: args[0],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        notificationId: args.notificationId,
    }

    return destroy.definition.url
            .replace('{notificationId}', parsedArgs.notificationId.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Settings\NotificationController::destroy
* @see app/Http/Controllers/Settings/NotificationController.php:18
* @route '/settings/profiles/notifications/{notificationId}'
*/
destroy.delete = (args: { notificationId: string | number } | [notificationId: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

/**
* @see \App\Http\Controllers\Settings\NotificationController::destroy
* @see app/Http/Controllers/Settings/NotificationController.php:18
* @route '/settings/profiles/notifications/{notificationId}'
*/
const destroyForm = (args: { notificationId: string | number } | [notificationId: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: destroy.url(args, {
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'DELETE',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'post',
})

/**
* @see \App\Http\Controllers\Settings\NotificationController::destroy
* @see app/Http/Controllers/Settings/NotificationController.php:18
* @route '/settings/profiles/notifications/{notificationId}'
*/
destroyForm.delete = (args: { notificationId: string | number } | [notificationId: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: destroy.url(args, {
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'DELETE',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'post',
})

destroy.form = destroyForm

const notifications = {
    index: Object.assign(index, index),
    destroy: Object.assign(destroy, destroy),
}

export default notifications