import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition, applyUrlDefaults, validateParameters } from './../../wayfinder'
import replies from './replies'
/**
* @see \Modules\Forum\Http\Controllers\ThreadController::index
* @see modules/Forum/Http/Controllers/ThreadController.php:35
* @route '/threads'
*/
export const index = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

index.definition = {
    methods: ["get","head"],
    url: '/threads',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \Modules\Forum\Http\Controllers\ThreadController::index
* @see modules/Forum/Http/Controllers/ThreadController.php:35
* @route '/threads'
*/
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \Modules\Forum\Http\Controllers\ThreadController::index
* @see modules/Forum/Http/Controllers/ThreadController.php:35
* @route '/threads'
*/
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

/**
* @see \Modules\Forum\Http\Controllers\ThreadController::index
* @see modules/Forum/Http/Controllers/ThreadController.php:35
* @route '/threads'
*/
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

/**
* @see \Modules\Forum\Http\Controllers\ThreadController::index
* @see modules/Forum/Http/Controllers/ThreadController.php:35
* @route '/threads'
*/
const indexForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: index.url(options),
    method: 'get',
})

/**
* @see \Modules\Forum\Http\Controllers\ThreadController::index
* @see modules/Forum/Http/Controllers/ThreadController.php:35
* @route '/threads'
*/
indexForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: index.url(options),
    method: 'get',
})

/**
* @see \Modules\Forum\Http\Controllers\ThreadController::index
* @see modules/Forum/Http/Controllers/ThreadController.php:35
* @route '/threads'
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

/**
* @see \Modules\Forum\Http\Controllers\ThreadController::create
* @see modules/Forum/Http/Controllers/ThreadController.php:53
* @route '/threads/create'
*/
export const create = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: create.url(options),
    method: 'get',
})

create.definition = {
    methods: ["get","head"],
    url: '/threads/create',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \Modules\Forum\Http\Controllers\ThreadController::create
* @see modules/Forum/Http/Controllers/ThreadController.php:53
* @route '/threads/create'
*/
create.url = (options?: RouteQueryOptions) => {
    return create.definition.url + queryParams(options)
}

/**
* @see \Modules\Forum\Http\Controllers\ThreadController::create
* @see modules/Forum/Http/Controllers/ThreadController.php:53
* @route '/threads/create'
*/
create.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: create.url(options),
    method: 'get',
})

/**
* @see \Modules\Forum\Http\Controllers\ThreadController::create
* @see modules/Forum/Http/Controllers/ThreadController.php:53
* @route '/threads/create'
*/
create.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: create.url(options),
    method: 'head',
})

/**
* @see \Modules\Forum\Http\Controllers\ThreadController::create
* @see modules/Forum/Http/Controllers/ThreadController.php:53
* @route '/threads/create'
*/
const createForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: create.url(options),
    method: 'get',
})

/**
* @see \Modules\Forum\Http\Controllers\ThreadController::create
* @see modules/Forum/Http/Controllers/ThreadController.php:53
* @route '/threads/create'
*/
createForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: create.url(options),
    method: 'get',
})

/**
* @see \Modules\Forum\Http\Controllers\ThreadController::create
* @see modules/Forum/Http/Controllers/ThreadController.php:53
* @route '/threads/create'
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
* @see modules/Forum/Http/Controllers/ThreadController.php:61
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
* @see modules/Forum/Http/Controllers/ThreadController.php:61
* @route '/threads'
*/
store.url = (options?: RouteQueryOptions) => {
    return store.definition.url + queryParams(options)
}

/**
* @see \Modules\Forum\Http\Controllers\ThreadController::store
* @see modules/Forum/Http/Controllers/ThreadController.php:61
* @route '/threads'
*/
store.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

/**
* @see \Modules\Forum\Http\Controllers\ThreadController::store
* @see modules/Forum/Http/Controllers/ThreadController.php:61
* @route '/threads'
*/
const storeForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: store.url(options),
    method: 'post',
})

/**
* @see \Modules\Forum\Http\Controllers\ThreadController::store
* @see modules/Forum/Http/Controllers/ThreadController.php:61
* @route '/threads'
*/
storeForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: store.url(options),
    method: 'post',
})

store.form = storeForm

/**
* @see \Modules\Forum\Http\Controllers\ThreadController::show
* @see modules/Forum/Http/Controllers/ThreadController.php:76
* @route '/threads/{channel}/{id}'
*/
export const show = (args: { channel: string | number, id: string | number } | [channel: string | number, id: string | number ], options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show.url(args, options),
    method: 'get',
})

show.definition = {
    methods: ["get","head"],
    url: '/threads/{channel}/{id}',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \Modules\Forum\Http\Controllers\ThreadController::show
* @see modules/Forum/Http/Controllers/ThreadController.php:76
* @route '/threads/{channel}/{id}'
*/
show.url = (args: { channel: string | number, id: string | number } | [channel: string | number, id: string | number ], options?: RouteQueryOptions) => {
    if (Array.isArray(args)) {
        args = {
            channel: args[0],
            id: args[1],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        channel: args.channel,
        id: args.id,
    }

    return show.definition.url
            .replace('{channel}', parsedArgs.channel.toString())
            .replace('{id}', parsedArgs.id.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \Modules\Forum\Http\Controllers\ThreadController::show
* @see modules/Forum/Http/Controllers/ThreadController.php:76
* @route '/threads/{channel}/{id}'
*/
show.get = (args: { channel: string | number, id: string | number } | [channel: string | number, id: string | number ], options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show.url(args, options),
    method: 'get',
})

/**
* @see \Modules\Forum\Http\Controllers\ThreadController::show
* @see modules/Forum/Http/Controllers/ThreadController.php:76
* @route '/threads/{channel}/{id}'
*/
show.head = (args: { channel: string | number, id: string | number } | [channel: string | number, id: string | number ], options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: show.url(args, options),
    method: 'head',
})

/**
* @see \Modules\Forum\Http\Controllers\ThreadController::show
* @see modules/Forum/Http/Controllers/ThreadController.php:76
* @route '/threads/{channel}/{id}'
*/
const showForm = (args: { channel: string | number, id: string | number } | [channel: string | number, id: string | number ], options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: show.url(args, options),
    method: 'get',
})

/**
* @see \Modules\Forum\Http\Controllers\ThreadController::show
* @see modules/Forum/Http/Controllers/ThreadController.php:76
* @route '/threads/{channel}/{id}'
*/
showForm.get = (args: { channel: string | number, id: string | number } | [channel: string | number, id: string | number ], options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: show.url(args, options),
    method: 'get',
})

/**
* @see \Modules\Forum\Http\Controllers\ThreadController::show
* @see modules/Forum/Http/Controllers/ThreadController.php:76
* @route '/threads/{channel}/{id}'
*/
showForm.head = (args: { channel: string | number, id: string | number } | [channel: string | number, id: string | number ], options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
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
* @see \Modules\Forum\Http\Controllers\ThreadController::channel
* @see modules/Forum/Http/Controllers/ThreadController.php:35
* @route '/threads/{channel?}'
*/
export const channel = (args?: { channel?: string | number } | [channel: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: channel.url(args, options),
    method: 'get',
})

channel.definition = {
    methods: ["get","head"],
    url: '/threads/{channel?}',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \Modules\Forum\Http\Controllers\ThreadController::channel
* @see modules/Forum/Http/Controllers/ThreadController.php:35
* @route '/threads/{channel?}'
*/
channel.url = (args?: { channel?: string | number } | [channel: string | number ] | string | number, options?: RouteQueryOptions) => {
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

    return channel.definition.url
            .replace('{channel?}', parsedArgs.channel?.toString() ?? '')
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \Modules\Forum\Http\Controllers\ThreadController::channel
* @see modules/Forum/Http/Controllers/ThreadController.php:35
* @route '/threads/{channel?}'
*/
channel.get = (args?: { channel?: string | number } | [channel: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: channel.url(args, options),
    method: 'get',
})

/**
* @see \Modules\Forum\Http\Controllers\ThreadController::channel
* @see modules/Forum/Http/Controllers/ThreadController.php:35
* @route '/threads/{channel?}'
*/
channel.head = (args?: { channel?: string | number } | [channel: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: channel.url(args, options),
    method: 'head',
})

/**
* @see \Modules\Forum\Http\Controllers\ThreadController::channel
* @see modules/Forum/Http/Controllers/ThreadController.php:35
* @route '/threads/{channel?}'
*/
const channelForm = (args?: { channel?: string | number } | [channel: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: channel.url(args, options),
    method: 'get',
})

/**
* @see \Modules\Forum\Http\Controllers\ThreadController::channel
* @see modules/Forum/Http/Controllers/ThreadController.php:35
* @route '/threads/{channel?}'
*/
channelForm.get = (args?: { channel?: string | number } | [channel: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: channel.url(args, options),
    method: 'get',
})

/**
* @see \Modules\Forum\Http\Controllers\ThreadController::channel
* @see modules/Forum/Http/Controllers/ThreadController.php:35
* @route '/threads/{channel?}'
*/
channelForm.head = (args?: { channel?: string | number } | [channel: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: channel.url(args, {
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'HEAD',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'get',
})

channel.form = channelForm

/**
* @see \Modules\Forum\Http\Controllers\ThreadController::destroy
* @see modules/Forum/Http/Controllers/ThreadController.php:82
* @route '/threads/{channel}/{id}'
*/
export const destroy = (args: { channel: string | number, id: string | number } | [channel: string | number, id: string | number ], options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

destroy.definition = {
    methods: ["delete"],
    url: '/threads/{channel}/{id}',
} satisfies RouteDefinition<["delete"]>

/**
* @see \Modules\Forum\Http\Controllers\ThreadController::destroy
* @see modules/Forum/Http/Controllers/ThreadController.php:82
* @route '/threads/{channel}/{id}'
*/
destroy.url = (args: { channel: string | number, id: string | number } | [channel: string | number, id: string | number ], options?: RouteQueryOptions) => {
    if (Array.isArray(args)) {
        args = {
            channel: args[0],
            id: args[1],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        channel: args.channel,
        id: args.id,
    }

    return destroy.definition.url
            .replace('{channel}', parsedArgs.channel.toString())
            .replace('{id}', parsedArgs.id.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \Modules\Forum\Http\Controllers\ThreadController::destroy
* @see modules/Forum/Http/Controllers/ThreadController.php:82
* @route '/threads/{channel}/{id}'
*/
destroy.delete = (args: { channel: string | number, id: string | number } | [channel: string | number, id: string | number ], options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

/**
* @see \Modules\Forum\Http\Controllers\ThreadController::destroy
* @see modules/Forum/Http/Controllers/ThreadController.php:82
* @route '/threads/{channel}/{id}'
*/
const destroyForm = (args: { channel: string | number, id: string | number } | [channel: string | number, id: string | number ], options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
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
* @see modules/Forum/Http/Controllers/ThreadController.php:82
* @route '/threads/{channel}/{id}'
*/
destroyForm.delete = (args: { channel: string | number, id: string | number } | [channel: string | number, id: string | number ], options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: destroy.url(args, {
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'DELETE',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'post',
})

destroy.form = destroyForm

const threads = {
    index: Object.assign(index, index),
    create: Object.assign(create, create),
    store: Object.assign(store, store),
    show: Object.assign(show, show),
    channel: Object.assign(channel, channel),
    destroy: Object.assign(destroy, destroy),
    replies: Object.assign(replies, replies),
}

export default threads