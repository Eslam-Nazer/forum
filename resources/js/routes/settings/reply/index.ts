import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition } from './../../../wayfinder'
/**
* @see \Modules\Forum\Http\Controllers\Settings\ReplyController::index
* @see modules/Forum/Http/Controllers/Settings/ReplyController.php:13
* @route '/settings/replies'
*/
export const index = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

index.definition = {
    methods: ["get","head"],
    url: '/settings/replies',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \Modules\Forum\Http\Controllers\Settings\ReplyController::index
* @see modules/Forum/Http/Controllers/Settings/ReplyController.php:13
* @route '/settings/replies'
*/
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \Modules\Forum\Http\Controllers\Settings\ReplyController::index
* @see modules/Forum/Http/Controllers/Settings/ReplyController.php:13
* @route '/settings/replies'
*/
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

/**
* @see \Modules\Forum\Http\Controllers\Settings\ReplyController::index
* @see modules/Forum/Http/Controllers/Settings/ReplyController.php:13
* @route '/settings/replies'
*/
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

/**
* @see \Modules\Forum\Http\Controllers\Settings\ReplyController::index
* @see modules/Forum/Http/Controllers/Settings/ReplyController.php:13
* @route '/settings/replies'
*/
const indexForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: index.url(options),
    method: 'get',
})

/**
* @see \Modules\Forum\Http\Controllers\Settings\ReplyController::index
* @see modules/Forum/Http/Controllers/Settings/ReplyController.php:13
* @route '/settings/replies'
*/
indexForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: index.url(options),
    method: 'get',
})

/**
* @see \Modules\Forum\Http\Controllers\Settings\ReplyController::index
* @see modules/Forum/Http/Controllers/Settings/ReplyController.php:13
* @route '/settings/replies'
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

const reply = {
    index: Object.assign(index, index),
}

export default reply