import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition, applyUrlDefaults } from './../../../../../wayfinder'
/**
* @see \Modules\Forum\Http\Controllers\ThreadSubScriptionController::store
* @see modules/Forum/Http/Controllers/ThreadSubScriptionController.php:22
* @route '/threads/{channel}/{slug}/subscriptions'
*/
export const store = (args: { channel: string | number, slug: string | number } | [channel: string | number, slug: string | number ], options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(args, options),
    method: 'post',
})

store.definition = {
    methods: ["post"],
    url: '/threads/{channel}/{slug}/subscriptions',
} satisfies RouteDefinition<["post"]>

/**
* @see \Modules\Forum\Http\Controllers\ThreadSubScriptionController::store
* @see modules/Forum/Http/Controllers/ThreadSubScriptionController.php:22
* @route '/threads/{channel}/{slug}/subscriptions'
*/
store.url = (args: { channel: string | number, slug: string | number } | [channel: string | number, slug: string | number ], options?: RouteQueryOptions) => {
    if (Array.isArray(args)) {
        args = {
            channel: args[0],
            slug: args[1],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        channel: args.channel,
        slug: args.slug,
    }

    return store.definition.url
            .replace('{channel}', parsedArgs.channel.toString())
            .replace('{slug}', parsedArgs.slug.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \Modules\Forum\Http\Controllers\ThreadSubScriptionController::store
* @see modules/Forum/Http/Controllers/ThreadSubScriptionController.php:22
* @route '/threads/{channel}/{slug}/subscriptions'
*/
store.post = (args: { channel: string | number, slug: string | number } | [channel: string | number, slug: string | number ], options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(args, options),
    method: 'post',
})

/**
* @see \Modules\Forum\Http\Controllers\ThreadSubScriptionController::store
* @see modules/Forum/Http/Controllers/ThreadSubScriptionController.php:22
* @route '/threads/{channel}/{slug}/subscriptions'
*/
const storeForm = (args: { channel: string | number, slug: string | number } | [channel: string | number, slug: string | number ], options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: store.url(args, options),
    method: 'post',
})

/**
* @see \Modules\Forum\Http\Controllers\ThreadSubScriptionController::store
* @see modules/Forum/Http/Controllers/ThreadSubScriptionController.php:22
* @route '/threads/{channel}/{slug}/subscriptions'
*/
storeForm.post = (args: { channel: string | number, slug: string | number } | [channel: string | number, slug: string | number ], options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: store.url(args, options),
    method: 'post',
})

store.form = storeForm

/**
* @see \Modules\Forum\Http\Controllers\ThreadSubScriptionController::destroy
* @see modules/Forum/Http/Controllers/ThreadSubScriptionController.php:32
* @route '/threads/{channel}/{slug}/subscriptions'
*/
export const destroy = (args: { channel: string | number, slug: string | number } | [channel: string | number, slug: string | number ], options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

destroy.definition = {
    methods: ["delete"],
    url: '/threads/{channel}/{slug}/subscriptions',
} satisfies RouteDefinition<["delete"]>

/**
* @see \Modules\Forum\Http\Controllers\ThreadSubScriptionController::destroy
* @see modules/Forum/Http/Controllers/ThreadSubScriptionController.php:32
* @route '/threads/{channel}/{slug}/subscriptions'
*/
destroy.url = (args: { channel: string | number, slug: string | number } | [channel: string | number, slug: string | number ], options?: RouteQueryOptions) => {
    if (Array.isArray(args)) {
        args = {
            channel: args[0],
            slug: args[1],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        channel: args.channel,
        slug: args.slug,
    }

    return destroy.definition.url
            .replace('{channel}', parsedArgs.channel.toString())
            .replace('{slug}', parsedArgs.slug.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \Modules\Forum\Http\Controllers\ThreadSubScriptionController::destroy
* @see modules/Forum/Http/Controllers/ThreadSubScriptionController.php:32
* @route '/threads/{channel}/{slug}/subscriptions'
*/
destroy.delete = (args: { channel: string | number, slug: string | number } | [channel: string | number, slug: string | number ], options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

/**
* @see \Modules\Forum\Http\Controllers\ThreadSubScriptionController::destroy
* @see modules/Forum/Http/Controllers/ThreadSubScriptionController.php:32
* @route '/threads/{channel}/{slug}/subscriptions'
*/
const destroyForm = (args: { channel: string | number, slug: string | number } | [channel: string | number, slug: string | number ], options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: destroy.url(args, {
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'DELETE',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'post',
})

/**
* @see \Modules\Forum\Http\Controllers\ThreadSubScriptionController::destroy
* @see modules/Forum/Http/Controllers/ThreadSubScriptionController.php:32
* @route '/threads/{channel}/{slug}/subscriptions'
*/
destroyForm.delete = (args: { channel: string | number, slug: string | number } | [channel: string | number, slug: string | number ], options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: destroy.url(args, {
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'DELETE',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'post',
})

destroy.form = destroyForm

const ThreadSubScriptionController = { store, destroy }

export default ThreadSubScriptionController