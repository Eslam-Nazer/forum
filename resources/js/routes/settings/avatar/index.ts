import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition } from './../../../wayfinder'
/**
* @see \Modules\Forum\Http\Controllers\Api\V1\AvatarController::index
* @see modules/Forum/Http/Controllers/Api/V1/AvatarController.php:27
* @route '/settings/avatar'
*/
export const index = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

index.definition = {
    methods: ["get","head"],
    url: '/settings/avatar',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \Modules\Forum\Http\Controllers\Api\V1\AvatarController::index
* @see modules/Forum/Http/Controllers/Api/V1/AvatarController.php:27
* @route '/settings/avatar'
*/
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \Modules\Forum\Http\Controllers\Api\V1\AvatarController::index
* @see modules/Forum/Http/Controllers/Api/V1/AvatarController.php:27
* @route '/settings/avatar'
*/
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

/**
* @see \Modules\Forum\Http\Controllers\Api\V1\AvatarController::index
* @see modules/Forum/Http/Controllers/Api/V1/AvatarController.php:27
* @route '/settings/avatar'
*/
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

/**
* @see \Modules\Forum\Http\Controllers\Api\V1\AvatarController::index
* @see modules/Forum/Http/Controllers/Api/V1/AvatarController.php:27
* @route '/settings/avatar'
*/
const indexForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: index.url(options),
    method: 'get',
})

/**
* @see \Modules\Forum\Http\Controllers\Api\V1\AvatarController::index
* @see modules/Forum/Http/Controllers/Api/V1/AvatarController.php:27
* @route '/settings/avatar'
*/
indexForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: index.url(options),
    method: 'get',
})

/**
* @see \Modules\Forum\Http\Controllers\Api\V1\AvatarController::index
* @see modules/Forum/Http/Controllers/Api/V1/AvatarController.php:27
* @route '/settings/avatar'
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

const avatar = {
    index: Object.assign(index, index),
}

export default avatar