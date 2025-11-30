import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition, applyUrlDefaults } from './../../../../../../../wayfinder'
/**
* @see \Modules\Forum\Http\Controllers\Api\V1\AvatarController::store
* @see modules/Forum/Http/Controllers/Api/V1/AvatarController.php:38
* @route '/api/users/{user}/avatar'
*/
export const store = (args: { user: string | number } | [user: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(args, options),
    method: 'post',
})

store.definition = {
    methods: ["post"],
    url: '/api/users/{user}/avatar',
} satisfies RouteDefinition<["post"]>

/**
* @see \Modules\Forum\Http\Controllers\Api\V1\AvatarController::store
* @see modules/Forum/Http/Controllers/Api/V1/AvatarController.php:38
* @route '/api/users/{user}/avatar'
*/
store.url = (args: { user: string | number } | [user: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { user: args }
    }

    if (Array.isArray(args)) {
        args = {
            user: args[0],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        user: args.user,
    }

    return store.definition.url
            .replace('{user}', parsedArgs.user.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \Modules\Forum\Http\Controllers\Api\V1\AvatarController::store
* @see modules/Forum/Http/Controllers/Api/V1/AvatarController.php:38
* @route '/api/users/{user}/avatar'
*/
store.post = (args: { user: string | number } | [user: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(args, options),
    method: 'post',
})

/**
* @see \Modules\Forum\Http\Controllers\Api\V1\AvatarController::store
* @see modules/Forum/Http/Controllers/Api/V1/AvatarController.php:38
* @route '/api/users/{user}/avatar'
*/
const storeForm = (args: { user: string | number } | [user: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: store.url(args, options),
    method: 'post',
})

/**
* @see \Modules\Forum\Http\Controllers\Api\V1\AvatarController::store
* @see modules/Forum/Http/Controllers/Api/V1/AvatarController.php:38
* @route '/api/users/{user}/avatar'
*/
storeForm.post = (args: { user: string | number } | [user: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: store.url(args, options),
    method: 'post',
})

store.form = storeForm

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

const AvatarController = { store, index }

export default AvatarController