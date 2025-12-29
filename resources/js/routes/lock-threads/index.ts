import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition, applyUrlDefaults } from './../../wayfinder'
/**
* @see \Modules\Forum\Http\Controllers\LockThreadsController::store
* @see modules/Forum/Http/Controllers/LockThreadsController.php:25
* @route '/threads/{slug}/lock'
*/
export const store = (args: { slug: string | number } | [slug: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(args, options),
    method: 'post',
})

store.definition = {
    methods: ["post"],
    url: '/threads/{slug}/lock',
} satisfies RouteDefinition<["post"]>

/**
* @see \Modules\Forum\Http\Controllers\LockThreadsController::store
* @see modules/Forum/Http/Controllers/LockThreadsController.php:25
* @route '/threads/{slug}/lock'
*/
store.url = (args: { slug: string | number } | [slug: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { slug: args }
    }

    if (Array.isArray(args)) {
        args = {
            slug: args[0],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        slug: args.slug,
    }

    return store.definition.url
            .replace('{slug}', parsedArgs.slug.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \Modules\Forum\Http\Controllers\LockThreadsController::store
* @see modules/Forum/Http/Controllers/LockThreadsController.php:25
* @route '/threads/{slug}/lock'
*/
store.post = (args: { slug: string | number } | [slug: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(args, options),
    method: 'post',
})

/**
* @see \Modules\Forum\Http\Controllers\LockThreadsController::store
* @see modules/Forum/Http/Controllers/LockThreadsController.php:25
* @route '/threads/{slug}/lock'
*/
const storeForm = (args: { slug: string | number } | [slug: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: store.url(args, options),
    method: 'post',
})

/**
* @see \Modules\Forum\Http\Controllers\LockThreadsController::store
* @see modules/Forum/Http/Controllers/LockThreadsController.php:25
* @route '/threads/{slug}/lock'
*/
storeForm.post = (args: { slug: string | number } | [slug: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: store.url(args, options),
    method: 'post',
})

store.form = storeForm

/**
* @see \Modules\Forum\Http\Controllers\LockThreadsController::destroy
* @see modules/Forum/Http/Controllers/LockThreadsController.php:34
* @route '/threads/{slug}/lock'
*/
export const destroy = (args: { slug: string | number } | [slug: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

destroy.definition = {
    methods: ["delete"],
    url: '/threads/{slug}/lock',
} satisfies RouteDefinition<["delete"]>

/**
* @see \Modules\Forum\Http\Controllers\LockThreadsController::destroy
* @see modules/Forum/Http/Controllers/LockThreadsController.php:34
* @route '/threads/{slug}/lock'
*/
destroy.url = (args: { slug: string | number } | [slug: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { slug: args }
    }

    if (Array.isArray(args)) {
        args = {
            slug: args[0],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        slug: args.slug,
    }

    return destroy.definition.url
            .replace('{slug}', parsedArgs.slug.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \Modules\Forum\Http\Controllers\LockThreadsController::destroy
* @see modules/Forum/Http/Controllers/LockThreadsController.php:34
* @route '/threads/{slug}/lock'
*/
destroy.delete = (args: { slug: string | number } | [slug: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

/**
* @see \Modules\Forum\Http\Controllers\LockThreadsController::destroy
* @see modules/Forum/Http/Controllers/LockThreadsController.php:34
* @route '/threads/{slug}/lock'
*/
const destroyForm = (args: { slug: string | number } | [slug: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: destroy.url(args, {
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'DELETE',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'post',
})

/**
* @see \Modules\Forum\Http\Controllers\LockThreadsController::destroy
* @see modules/Forum/Http/Controllers/LockThreadsController.php:34
* @route '/threads/{slug}/lock'
*/
destroyForm.delete = (args: { slug: string | number } | [slug: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: destroy.url(args, {
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'DELETE',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'post',
})

destroy.form = destroyForm

const lockThreads = {
    store: Object.assign(store, store),
    destroy: Object.assign(destroy, destroy),
}

export default lockThreads