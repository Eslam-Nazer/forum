import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition, applyUrlDefaults, validateParameters } from './../../../../../wayfinder'
/**
* @see \Modules\Forum\Http\Controllers\ThreadController::index
* @see modules/Forum/Http/Controllers/ThreadController.php:42
* @route '/threads'
*/
const index104a984c506b0fe3d31b6cba79f478c6 = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index104a984c506b0fe3d31b6cba79f478c6.url(options),
    method: 'get',
})

index104a984c506b0fe3d31b6cba79f478c6.definition = {
    methods: ["get","head"],
    url: '/threads',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \Modules\Forum\Http\Controllers\ThreadController::index
* @see modules/Forum/Http/Controllers/ThreadController.php:42
* @route '/threads'
*/
index104a984c506b0fe3d31b6cba79f478c6.url = (options?: RouteQueryOptions) => {
    return index104a984c506b0fe3d31b6cba79f478c6.definition.url + queryParams(options)
}

/**
* @see \Modules\Forum\Http\Controllers\ThreadController::index
* @see modules/Forum/Http/Controllers/ThreadController.php:42
* @route '/threads'
*/
index104a984c506b0fe3d31b6cba79f478c6.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index104a984c506b0fe3d31b6cba79f478c6.url(options),
    method: 'get',
})

/**
* @see \Modules\Forum\Http\Controllers\ThreadController::index
* @see modules/Forum/Http/Controllers/ThreadController.php:42
* @route '/threads'
*/
index104a984c506b0fe3d31b6cba79f478c6.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index104a984c506b0fe3d31b6cba79f478c6.url(options),
    method: 'head',
})

/**
* @see \Modules\Forum\Http\Controllers\ThreadController::index
* @see modules/Forum/Http/Controllers/ThreadController.php:42
* @route '/threads'
*/
const index104a984c506b0fe3d31b6cba79f478c6Form = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: index104a984c506b0fe3d31b6cba79f478c6.url(options),
    method: 'get',
})

/**
* @see \Modules\Forum\Http\Controllers\ThreadController::index
* @see modules/Forum/Http/Controllers/ThreadController.php:42
* @route '/threads'
*/
index104a984c506b0fe3d31b6cba79f478c6Form.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: index104a984c506b0fe3d31b6cba79f478c6.url(options),
    method: 'get',
})

/**
* @see \Modules\Forum\Http\Controllers\ThreadController::index
* @see modules/Forum/Http/Controllers/ThreadController.php:42
* @route '/threads'
*/
index104a984c506b0fe3d31b6cba79f478c6Form.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: index104a984c506b0fe3d31b6cba79f478c6.url({
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'HEAD',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'get',
})

index104a984c506b0fe3d31b6cba79f478c6.form = index104a984c506b0fe3d31b6cba79f478c6Form
/**
* @see \Modules\Forum\Http\Controllers\ThreadController::index
* @see modules/Forum/Http/Controllers/ThreadController.php:42
* @route '/threads/{channel?}'
*/
const index7e669d1a5d8a662265f204dd7deba91b = (args?: { channel?: string | number } | [channel: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index7e669d1a5d8a662265f204dd7deba91b.url(args, options),
    method: 'get',
})

index7e669d1a5d8a662265f204dd7deba91b.definition = {
    methods: ["get","head"],
    url: '/threads/{channel?}',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \Modules\Forum\Http\Controllers\ThreadController::index
* @see modules/Forum/Http/Controllers/ThreadController.php:42
* @route '/threads/{channel?}'
*/
index7e669d1a5d8a662265f204dd7deba91b.url = (args?: { channel?: string | number } | [channel: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { channel: args }
    }

    if (Array.isArray(args)) {
        args = {
            channel: args[0],
        }
    }

    args = applyUrlDefaults(args)

    validateParameters(args, [
        "channel",
    ])

    const parsedArgs = {
        channel: args?.channel,
    }

    return index7e669d1a5d8a662265f204dd7deba91b.definition.url
            .replace('{channel?}', parsedArgs.channel?.toString() ?? '')
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \Modules\Forum\Http\Controllers\ThreadController::index
* @see modules/Forum/Http/Controllers/ThreadController.php:42
* @route '/threads/{channel?}'
*/
index7e669d1a5d8a662265f204dd7deba91b.get = (args?: { channel?: string | number } | [channel: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index7e669d1a5d8a662265f204dd7deba91b.url(args, options),
    method: 'get',
})

/**
* @see \Modules\Forum\Http\Controllers\ThreadController::index
* @see modules/Forum/Http/Controllers/ThreadController.php:42
* @route '/threads/{channel?}'
*/
index7e669d1a5d8a662265f204dd7deba91b.head = (args?: { channel?: string | number } | [channel: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index7e669d1a5d8a662265f204dd7deba91b.url(args, options),
    method: 'head',
})

/**
* @see \Modules\Forum\Http\Controllers\ThreadController::index
* @see modules/Forum/Http/Controllers/ThreadController.php:42
* @route '/threads/{channel?}'
*/
const index7e669d1a5d8a662265f204dd7deba91bForm = (args?: { channel?: string | number } | [channel: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: index7e669d1a5d8a662265f204dd7deba91b.url(args, options),
    method: 'get',
})

/**
* @see \Modules\Forum\Http\Controllers\ThreadController::index
* @see modules/Forum/Http/Controllers/ThreadController.php:42
* @route '/threads/{channel?}'
*/
index7e669d1a5d8a662265f204dd7deba91bForm.get = (args?: { channel?: string | number } | [channel: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: index7e669d1a5d8a662265f204dd7deba91b.url(args, options),
    method: 'get',
})

/**
* @see \Modules\Forum\Http\Controllers\ThreadController::index
* @see modules/Forum/Http/Controllers/ThreadController.php:42
* @route '/threads/{channel?}'
*/
index7e669d1a5d8a662265f204dd7deba91bForm.head = (args?: { channel?: string | number } | [channel: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: index7e669d1a5d8a662265f204dd7deba91b.url(args, {
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'HEAD',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'get',
})

index7e669d1a5d8a662265f204dd7deba91b.form = index7e669d1a5d8a662265f204dd7deba91bForm

export const index = {
    '/threads': index104a984c506b0fe3d31b6cba79f478c6,
    '/threads/{channel?}': index7e669d1a5d8a662265f204dd7deba91b,
}

/**
* @see \Modules\Forum\Http\Controllers\ThreadController::create
* @see modules/Forum/Http/Controllers/ThreadController.php:61
* @route '/threads/t/create'
*/
export const create = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: create.url(options),
    method: 'get',
})

create.definition = {
    methods: ["get","head"],
    url: '/threads/t/create',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \Modules\Forum\Http\Controllers\ThreadController::create
* @see modules/Forum/Http/Controllers/ThreadController.php:61
* @route '/threads/t/create'
*/
create.url = (options?: RouteQueryOptions) => {
    return create.definition.url + queryParams(options)
}

/**
* @see \Modules\Forum\Http\Controllers\ThreadController::create
* @see modules/Forum/Http/Controllers/ThreadController.php:61
* @route '/threads/t/create'
*/
create.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: create.url(options),
    method: 'get',
})

/**
* @see \Modules\Forum\Http\Controllers\ThreadController::create
* @see modules/Forum/Http/Controllers/ThreadController.php:61
* @route '/threads/t/create'
*/
create.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: create.url(options),
    method: 'head',
})

/**
* @see \Modules\Forum\Http\Controllers\ThreadController::create
* @see modules/Forum/Http/Controllers/ThreadController.php:61
* @route '/threads/t/create'
*/
const createForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: create.url(options),
    method: 'get',
})

/**
* @see \Modules\Forum\Http\Controllers\ThreadController::create
* @see modules/Forum/Http/Controllers/ThreadController.php:61
* @route '/threads/t/create'
*/
createForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: create.url(options),
    method: 'get',
})

/**
* @see \Modules\Forum\Http\Controllers\ThreadController::create
* @see modules/Forum/Http/Controllers/ThreadController.php:61
* @route '/threads/t/create'
*/
createForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: create.url({
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'HEAD',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'get',
})

create.form = createForm

/**
* @see \Modules\Forum\Http\Controllers\ThreadController::store
* @see modules/Forum/Http/Controllers/ThreadController.php:69
* @route '/threads'
*/
export const store = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

store.definition = {
    methods: ["post"],
    url: '/threads',
} satisfies RouteDefinition<["post"]>

/**
* @see \Modules\Forum\Http\Controllers\ThreadController::store
* @see modules/Forum/Http/Controllers/ThreadController.php:69
* @route '/threads'
*/
store.url = (options?: RouteQueryOptions) => {
    return store.definition.url + queryParams(options)
}

/**
* @see \Modules\Forum\Http\Controllers\ThreadController::store
* @see modules/Forum/Http/Controllers/ThreadController.php:69
* @route '/threads'
*/
store.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

/**
* @see \Modules\Forum\Http\Controllers\ThreadController::store
* @see modules/Forum/Http/Controllers/ThreadController.php:69
* @route '/threads'
*/
const storeForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: store.url(options),
    method: 'post',
})

/**
* @see \Modules\Forum\Http\Controllers\ThreadController::store
* @see modules/Forum/Http/Controllers/ThreadController.php:69
* @route '/threads'
*/
storeForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: store.url(options),
    method: 'post',
})

store.form = storeForm

/**
* @see \Modules\Forum\Http\Controllers\ThreadController::show
* @see modules/Forum/Http/Controllers/ThreadController.php:90
* @route '/threads/{channel}/{slug}'
*/
export const show = (args: { channel: string | number, slug: string | number } | [channel: string | number, slug: string | number ], options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show.url(args, options),
    method: 'get',
})

show.definition = {
    methods: ["get","head"],
    url: '/threads/{channel}/{slug}',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \Modules\Forum\Http\Controllers\ThreadController::show
* @see modules/Forum/Http/Controllers/ThreadController.php:90
* @route '/threads/{channel}/{slug}'
*/
show.url = (args: { channel: string | number, slug: string | number } | [channel: string | number, slug: string | number ], options?: RouteQueryOptions) => {
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

    return show.definition.url
            .replace('{channel}', parsedArgs.channel.toString())
            .replace('{slug}', parsedArgs.slug.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \Modules\Forum\Http\Controllers\ThreadController::show
* @see modules/Forum/Http/Controllers/ThreadController.php:90
* @route '/threads/{channel}/{slug}'
*/
show.get = (args: { channel: string | number, slug: string | number } | [channel: string | number, slug: string | number ], options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show.url(args, options),
    method: 'get',
})

/**
* @see \Modules\Forum\Http\Controllers\ThreadController::show
* @see modules/Forum/Http/Controllers/ThreadController.php:90
* @route '/threads/{channel}/{slug}'
*/
show.head = (args: { channel: string | number, slug: string | number } | [channel: string | number, slug: string | number ], options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: show.url(args, options),
    method: 'head',
})

/**
* @see \Modules\Forum\Http\Controllers\ThreadController::show
* @see modules/Forum/Http/Controllers/ThreadController.php:90
* @route '/threads/{channel}/{slug}'
*/
const showForm = (args: { channel: string | number, slug: string | number } | [channel: string | number, slug: string | number ], options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: show.url(args, options),
    method: 'get',
})

/**
* @see \Modules\Forum\Http\Controllers\ThreadController::show
* @see modules/Forum/Http/Controllers/ThreadController.php:90
* @route '/threads/{channel}/{slug}'
*/
showForm.get = (args: { channel: string | number, slug: string | number } | [channel: string | number, slug: string | number ], options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: show.url(args, options),
    method: 'get',
})

/**
* @see \Modules\Forum\Http\Controllers\ThreadController::show
* @see modules/Forum/Http/Controllers/ThreadController.php:90
* @route '/threads/{channel}/{slug}'
*/
showForm.head = (args: { channel: string | number, slug: string | number } | [channel: string | number, slug: string | number ], options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: show.url(args, {
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'HEAD',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'get',
})

show.form = showForm

/**
* @see \Modules\Forum\Http\Controllers\ThreadController::destroy
* @see modules/Forum/Http/Controllers/ThreadController.php:99
* @route '/threads/{channel}/{slug}'
*/
export const destroy = (args: { channel: string | number, slug: string | number } | [channel: string | number, slug: string | number ], options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

destroy.definition = {
    methods: ["delete"],
    url: '/threads/{channel}/{slug}',
} satisfies RouteDefinition<["delete"]>

/**
* @see \Modules\Forum\Http\Controllers\ThreadController::destroy
* @see modules/Forum/Http/Controllers/ThreadController.php:99
* @route '/threads/{channel}/{slug}'
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
* @see \Modules\Forum\Http\Controllers\ThreadController::destroy
* @see modules/Forum/Http/Controllers/ThreadController.php:99
* @route '/threads/{channel}/{slug}'
*/
destroy.delete = (args: { channel: string | number, slug: string | number } | [channel: string | number, slug: string | number ], options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

/**
* @see \Modules\Forum\Http\Controllers\ThreadController::destroy
* @see modules/Forum/Http/Controllers/ThreadController.php:99
* @route '/threads/{channel}/{slug}'
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
* @see \Modules\Forum\Http\Controllers\ThreadController::destroy
* @see modules/Forum/Http/Controllers/ThreadController.php:99
* @route '/threads/{channel}/{slug}'
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

const ThreadController = { index, create, store, show, destroy }

export default ThreadController