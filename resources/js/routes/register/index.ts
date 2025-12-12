import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition } from './../../wayfinder'
/**
* @see \App\Http\Controllers\Auth\RegisteredUserController::store
* @see app/Http/Controllers/Auth/RegisteredUserController.php:32
* @route '/register'
*/
export const store = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

store.definition = {
    methods: ["post"],
    url: '/register',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\Auth\RegisteredUserController::store
* @see app/Http/Controllers/Auth/RegisteredUserController.php:32
* @route '/register'
*/
store.url = (options?: RouteQueryOptions) => {
    return store.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Auth\RegisteredUserController::store
* @see app/Http/Controllers/Auth/RegisteredUserController.php:32
* @route '/register'
*/
store.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\Auth\RegisteredUserController::store
* @see app/Http/Controllers/Auth/RegisteredUserController.php:32
* @route '/register'
*/
const storeForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: store.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\Auth\RegisteredUserController::store
* @see app/Http/Controllers/Auth/RegisteredUserController.php:32
* @route '/register'
*/
storeForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: store.url(options),
    method: 'post',
})

store.form = storeForm

/**
* @see \Modules\Forum\Http\Controllers\RegisterConfirmationController::confirm
* @see modules/Forum/Http/Controllers/RegisterConfirmationController.php:17
* @route '/register/confirm'
*/
export const confirm = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: confirm.url(options),
    method: 'get',
})

confirm.definition = {
    methods: ["get","head"],
    url: '/register/confirm',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \Modules\Forum\Http\Controllers\RegisterConfirmationController::confirm
* @see modules/Forum/Http/Controllers/RegisterConfirmationController.php:17
* @route '/register/confirm'
*/
confirm.url = (options?: RouteQueryOptions) => {
    return confirm.definition.url + queryParams(options)
}

/**
* @see \Modules\Forum\Http\Controllers\RegisterConfirmationController::confirm
* @see modules/Forum/Http/Controllers/RegisterConfirmationController.php:17
* @route '/register/confirm'
*/
confirm.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: confirm.url(options),
    method: 'get',
})

/**
* @see \Modules\Forum\Http\Controllers\RegisterConfirmationController::confirm
* @see modules/Forum/Http/Controllers/RegisterConfirmationController.php:17
* @route '/register/confirm'
*/
confirm.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: confirm.url(options),
    method: 'head',
})

/**
* @see \Modules\Forum\Http\Controllers\RegisterConfirmationController::confirm
* @see modules/Forum/Http/Controllers/RegisterConfirmationController.php:17
* @route '/register/confirm'
*/
const confirmForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: confirm.url(options),
    method: 'get',
})

/**
* @see \Modules\Forum\Http\Controllers\RegisterConfirmationController::confirm
* @see modules/Forum/Http/Controllers/RegisterConfirmationController.php:17
* @route '/register/confirm'
*/
confirmForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: confirm.url(options),
    method: 'get',
})

/**
* @see \Modules\Forum\Http\Controllers\RegisterConfirmationController::confirm
* @see modules/Forum/Http/Controllers/RegisterConfirmationController.php:17
* @route '/register/confirm'
*/
confirmForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: confirm.url({
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'HEAD',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'get',
})

confirm.form = confirmForm

const register = {
    store: Object.assign(store, store),
    confirm: Object.assign(confirm, confirm),
}

export default register