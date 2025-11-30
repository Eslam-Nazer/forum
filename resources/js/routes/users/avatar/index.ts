import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition, applyUrlDefaults } from './../../../wayfinder'
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

const avatar = {
    store: Object.assign(store, store),
}

export default avatar