import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition, applyUrlDefaults } from './../../../../../wayfinder'
/**
* @see \Modules\Forum\Http\Controllers\ReplyController::store
* @see modules/Forum/Http/Controllers/ReplyController.php:35
* @route '/threads/{threadSlug}/replies'
*/
export const store = (args: { threadSlug: string | number } | [threadSlug: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(args, options),
    method: 'post',
})

store.definition = {
    methods: ["post"],
    url: '/threads/{threadSlug}/replies',
} satisfies RouteDefinition<["post"]>

/**
* @see \Modules\Forum\Http\Controllers\ReplyController::store
* @see modules/Forum/Http/Controllers/ReplyController.php:35
* @route '/threads/{threadSlug}/replies'
*/
store.url = (args: { threadSlug: string | number } | [threadSlug: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { threadSlug: args }
    }

    if (Array.isArray(args)) {
        args = {
            threadSlug: args[0],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        threadSlug: args.threadSlug,
    }

    return store.definition.url
            .replace('{threadSlug}', parsedArgs.threadSlug.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \Modules\Forum\Http\Controllers\ReplyController::store
* @see modules/Forum/Http/Controllers/ReplyController.php:35
* @route '/threads/{threadSlug}/replies'
*/
store.post = (args: { threadSlug: string | number } | [threadSlug: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(args, options),
    method: 'post',
})

/**
* @see \Modules\Forum\Http\Controllers\ReplyController::store
* @see modules/Forum/Http/Controllers/ReplyController.php:35
* @route '/threads/{threadSlug}/replies'
*/
const storeForm = (args: { threadSlug: string | number } | [threadSlug: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: store.url(args, options),
    method: 'post',
})

/**
* @see \Modules\Forum\Http\Controllers\ReplyController::store
* @see modules/Forum/Http/Controllers/ReplyController.php:35
* @route '/threads/{threadSlug}/replies'
*/
storeForm.post = (args: { threadSlug: string | number } | [threadSlug: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: store.url(args, options),
    method: 'post',
})

store.form = storeForm

/**
* @see \Modules\Forum\Http\Controllers\ReplyController::update
* @see modules/Forum/Http/Controllers/ReplyController.php:50
* @route '/replies/{id}'
*/
export const update = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'patch'> => ({
    url: update.url(args, options),
    method: 'patch',
})

update.definition = {
    methods: ["patch"],
    url: '/replies/{id}',
} satisfies RouteDefinition<["patch"]>

/**
* @see \Modules\Forum\Http\Controllers\ReplyController::update
* @see modules/Forum/Http/Controllers/ReplyController.php:50
* @route '/replies/{id}'
*/
update.url = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { id: args }
    }

    if (Array.isArray(args)) {
        args = {
            id: args[0],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        id: args.id,
    }

    return update.definition.url
            .replace('{id}', parsedArgs.id.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \Modules\Forum\Http\Controllers\ReplyController::update
* @see modules/Forum/Http/Controllers/ReplyController.php:50
* @route '/replies/{id}'
*/
update.patch = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'patch'> => ({
    url: update.url(args, options),
    method: 'patch',
})

/**
* @see \Modules\Forum\Http\Controllers\ReplyController::update
* @see modules/Forum/Http/Controllers/ReplyController.php:50
* @route '/replies/{id}'
*/
const updateForm = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: update.url(args, {
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'PATCH',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'post',
})

/**
* @see \Modules\Forum\Http\Controllers\ReplyController::update
* @see modules/Forum/Http/Controllers/ReplyController.php:50
* @route '/replies/{id}'
*/
updateForm.patch = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: update.url(args, {
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'PATCH',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'post',
})

update.form = updateForm

/**
* @see \Modules\Forum\Http\Controllers\ReplyController::destroy
* @see modules/Forum/Http/Controllers/ReplyController.php:62
* @route '/replies/{id}'
*/
export const destroy = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

destroy.definition = {
    methods: ["delete"],
    url: '/replies/{id}',
} satisfies RouteDefinition<["delete"]>

/**
* @see \Modules\Forum\Http\Controllers\ReplyController::destroy
* @see modules/Forum/Http/Controllers/ReplyController.php:62
* @route '/replies/{id}'
*/
destroy.url = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { id: args }
    }

    if (Array.isArray(args)) {
        args = {
            id: args[0],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        id: args.id,
    }

    return destroy.definition.url
            .replace('{id}', parsedArgs.id.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \Modules\Forum\Http\Controllers\ReplyController::destroy
* @see modules/Forum/Http/Controllers/ReplyController.php:62
* @route '/replies/{id}'
*/
destroy.delete = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

/**
* @see \Modules\Forum\Http\Controllers\ReplyController::destroy
* @see modules/Forum/Http/Controllers/ReplyController.php:62
* @route '/replies/{id}'
*/
const destroyForm = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: destroy.url(args, {
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'DELETE',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'post',
})

/**
* @see \Modules\Forum\Http\Controllers\ReplyController::destroy
* @see modules/Forum/Http/Controllers/ReplyController.php:62
* @route '/replies/{id}'
*/
destroyForm.delete = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: destroy.url(args, {
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'DELETE',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'post',
})

destroy.form = destroyForm

const ReplyController = { store, update, destroy }

export default ReplyController