import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition } from './../../../wayfinder'
/**
* @see \Modules\Forum\Http\Controllers\Settings\ThreadController::index
* @see modules/Forum/Http/Controllers/Settings/ThreadController.php:14
* @route '/settings/threads'
*/
export const index = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

index.definition = {
    methods: ["get","head"],
    url: '/settings/threads',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \Modules\Forum\Http\Controllers\Settings\ThreadController::index
* @see modules/Forum/Http/Controllers/Settings/ThreadController.php:14
* @route '/settings/threads'
*/
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \Modules\Forum\Http\Controllers\Settings\ThreadController::index
* @see modules/Forum/Http/Controllers/Settings/ThreadController.php:14
* @route '/settings/threads'
*/
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

/**
* @see \Modules\Forum\Http\Controllers\Settings\ThreadController::index
* @see modules/Forum/Http/Controllers/Settings/ThreadController.php:14
* @route '/settings/threads'
*/
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

/**
* @see \Modules\Forum\Http\Controllers\Settings\ThreadController::index
* @see modules/Forum/Http/Controllers/Settings/ThreadController.php:14
* @route '/settings/threads'
*/
const indexForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: index.url(options),
    method: 'get',
})

/**
* @see \Modules\Forum\Http\Controllers\Settings\ThreadController::index
* @see modules/Forum/Http/Controllers/Settings/ThreadController.php:14
* @route '/settings/threads'
*/
indexForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: index.url(options),
    method: 'get',
})

/**
* @see \Modules\Forum\Http\Controllers\Settings\ThreadController::index
* @see modules/Forum/Http/Controllers/Settings/ThreadController.php:14
* @route '/settings/threads'
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

const threads = {
    index: Object.assign(index, index),
}

export default threads