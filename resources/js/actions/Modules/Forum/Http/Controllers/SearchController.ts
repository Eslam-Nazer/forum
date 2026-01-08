import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition } from './../../../../../wayfinder'
/**
* @see \Modules\Forum\Http\Controllers\SearchController::show
* @see modules/Forum/Http/Controllers/SearchController.php:19
* @route '/threads/search'
*/
export const show = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show.url(options),
    method: 'get',
})

show.definition = {
    methods: ["get","head"],
    url: '/threads/search',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \Modules\Forum\Http\Controllers\SearchController::show
* @see modules/Forum/Http/Controllers/SearchController.php:19
* @route '/threads/search'
*/
show.url = (options?: RouteQueryOptions) => {
    return show.definition.url + queryParams(options)
}

/**
* @see \Modules\Forum\Http\Controllers\SearchController::show
* @see modules/Forum/Http/Controllers/SearchController.php:19
* @route '/threads/search'
*/
show.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show.url(options),
    method: 'get',
})

/**
* @see \Modules\Forum\Http\Controllers\SearchController::show
* @see modules/Forum/Http/Controllers/SearchController.php:19
* @route '/threads/search'
*/
show.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: show.url(options),
    method: 'head',
})

/**
* @see \Modules\Forum\Http\Controllers\SearchController::show
* @see modules/Forum/Http/Controllers/SearchController.php:19
* @route '/threads/search'
*/
const showForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: show.url(options),
    method: 'get',
})

/**
* @see \Modules\Forum\Http\Controllers\SearchController::show
* @see modules/Forum/Http/Controllers/SearchController.php:19
* @route '/threads/search'
*/
showForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: show.url(options),
    method: 'get',
})

/**
* @see \Modules\Forum\Http\Controllers\SearchController::show
* @see modules/Forum/Http/Controllers/SearchController.php:19
* @route '/threads/search'
*/
showForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: show.url({
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'HEAD',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'get',
})

show.form = showForm

const SearchController = { show }

export default SearchController