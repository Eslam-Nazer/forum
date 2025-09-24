import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition } from './../../../../../../wayfinder'
/**
* @see \Modules\Forum\Http\Controllers\Settings\ActivityController::index
* @see modules/Forum/Http/Controllers/Settings/ActivityController.php:13
* @route '/settings/activities'
*/
export const index = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

index.definition = {
    methods: ["get","head"],
    url: '/settings/activities',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \Modules\Forum\Http\Controllers\Settings\ActivityController::index
* @see modules/Forum/Http/Controllers/Settings/ActivityController.php:13
* @route '/settings/activities'
*/
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \Modules\Forum\Http\Controllers\Settings\ActivityController::index
* @see modules/Forum/Http/Controllers/Settings/ActivityController.php:13
* @route '/settings/activities'
*/
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

/**
* @see \Modules\Forum\Http\Controllers\Settings\ActivityController::index
* @see modules/Forum/Http/Controllers/Settings/ActivityController.php:13
* @route '/settings/activities'
*/
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

/**
* @see \Modules\Forum\Http\Controllers\Settings\ActivityController::index
* @see modules/Forum/Http/Controllers/Settings/ActivityController.php:13
* @route '/settings/activities'
*/
const indexForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: index.url(options),
    method: 'get',
})

/**
* @see \Modules\Forum\Http\Controllers\Settings\ActivityController::index
* @see modules/Forum/Http/Controllers/Settings/ActivityController.php:13
* @route '/settings/activities'
*/
indexForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: index.url(options),
    method: 'get',
})

/**
* @see \Modules\Forum\Http\Controllers\Settings\ActivityController::index
* @see modules/Forum/Http/Controllers/Settings/ActivityController.php:13
* @route '/settings/activities'
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

const ActivityController = { index }

export default ActivityController