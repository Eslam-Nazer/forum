import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition, applyUrlDefaults } from './../../wayfinder'
/**
* @see \Modules\Forum\Http\Controllers\LockThreadsController::store
* @see modules/Forum/Http/Controllers/LockThreadsController.php:24
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
* @see modules/Forum/Http/Controllers/LockThreadsController.php:24
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
* @see modules/Forum/Http/Controllers/LockThreadsController.php:24
* @route '/threads/{slug}/lock'
*/
store.post = (args: { slug: string | number } | [slug: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(args, options),
    method: 'post',
})

/**
* @see \Modules\Forum\Http\Controllers\LockThreadsController::store
* @see modules/Forum/Http/Controllers/LockThreadsController.php:24
* @route '/threads/{slug}/lock'
*/
const storeForm = (args: { slug: string | number } | [slug: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: store.url(args, options),
    method: 'post',
})

/**
* @see \Modules\Forum\Http\Controllers\LockThreadsController::store
* @see modules/Forum/Http/Controllers/LockThreadsController.php:24
* @route '/threads/{slug}/lock'
*/
storeForm.post = (args: { slug: string | number } | [slug: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: store.url(args, options),
    method: 'post',
})

store.form = storeForm

const lockThreads = {
    store: Object.assign(store, store),
}

export default lockThreads