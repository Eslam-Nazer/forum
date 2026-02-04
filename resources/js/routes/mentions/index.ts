import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition } from './../../wayfinder'
/**
* @see \Modules\Forum\Http\Controllers\Api\V1\MentionsController::index
* @see modules/Forum/Http/Controllers/Api/V1/MentionsController.php:15
* @route '/api/v1/mentions'
*/
export const index = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

index.definition = {
    methods: ["get","head"],
    url: '/api/v1/mentions',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \Modules\Forum\Http\Controllers\Api\V1\MentionsController::index
* @see modules/Forum/Http/Controllers/Api/V1/MentionsController.php:15
* @route '/api/v1/mentions'
*/
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \Modules\Forum\Http\Controllers\Api\V1\MentionsController::index
* @see modules/Forum/Http/Controllers/Api/V1/MentionsController.php:15
* @route '/api/v1/mentions'
*/
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

/**
* @see \Modules\Forum\Http\Controllers\Api\V1\MentionsController::index
* @see modules/Forum/Http/Controllers/Api/V1/MentionsController.php:15
* @route '/api/v1/mentions'
*/
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

/**
* @see \Modules\Forum\Http\Controllers\Api\V1\MentionsController::index
* @see modules/Forum/Http/Controllers/Api/V1/MentionsController.php:15
* @route '/api/v1/mentions'
*/
const indexForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: index.url(options),
    method: 'get',
})

/**
* @see \Modules\Forum\Http\Controllers\Api\V1\MentionsController::index
* @see modules/Forum/Http/Controllers/Api/V1/MentionsController.php:15
* @route '/api/v1/mentions'
*/
indexForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: index.url(options),
    method: 'get',
})

/**
* @see \Modules\Forum\Http\Controllers\Api\V1\MentionsController::index
* @see modules/Forum/Http/Controllers/Api/V1/MentionsController.php:15
* @route '/api/v1/mentions'
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

const mentions = {
    index: Object.assign(index, index),
}

export default mentions