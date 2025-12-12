import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition } from './../../../../../wayfinder'
/**
* @see \Modules\Forum\Http\Controllers\RegisterConfirmationController::index
* @see modules/Forum/Http/Controllers/RegisterConfirmationController.php:18
* @route '/register/confirm'
*/
export const index = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

index.definition = {
    methods: ["get","head"],
    url: '/register/confirm',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \Modules\Forum\Http\Controllers\RegisterConfirmationController::index
* @see modules/Forum/Http/Controllers/RegisterConfirmationController.php:18
* @route '/register/confirm'
*/
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \Modules\Forum\Http\Controllers\RegisterConfirmationController::index
* @see modules/Forum/Http/Controllers/RegisterConfirmationController.php:18
* @route '/register/confirm'
*/
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

/**
* @see \Modules\Forum\Http\Controllers\RegisterConfirmationController::index
* @see modules/Forum/Http/Controllers/RegisterConfirmationController.php:18
* @route '/register/confirm'
*/
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

/**
* @see \Modules\Forum\Http\Controllers\RegisterConfirmationController::index
* @see modules/Forum/Http/Controllers/RegisterConfirmationController.php:18
* @route '/register/confirm'
*/
const indexForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: index.url(options),
    method: 'get',
})

/**
* @see \Modules\Forum\Http\Controllers\RegisterConfirmationController::index
* @see modules/Forum/Http/Controllers/RegisterConfirmationController.php:18
* @route '/register/confirm'
*/
indexForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: index.url(options),
    method: 'get',
})

/**
* @see \Modules\Forum\Http\Controllers\RegisterConfirmationController::index
* @see modules/Forum/Http/Controllers/RegisterConfirmationController.php:18
* @route '/register/confirm'
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

const RegisterConfirmationController = { index }

export default RegisterConfirmationController