import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition, applyUrlDefaults } from './../../../wayfinder'
/**
* @see \Modules\Forum\Http\Controllers\ForumController::index
* @see modules/Forum/Http/Controllers/ForumController.php:13
* @route '/api/v1/forums'
*/
export const index = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

index.definition = {
    methods: ["get","head"],
    url: '/api/v1/forums',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \Modules\Forum\Http\Controllers\ForumController::index
* @see modules/Forum/Http/Controllers/ForumController.php:13
* @route '/api/v1/forums'
*/
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \Modules\Forum\Http\Controllers\ForumController::index
* @see modules/Forum/Http/Controllers/ForumController.php:13
* @route '/api/v1/forums'
*/
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

/**
* @see \Modules\Forum\Http\Controllers\ForumController::index
* @see modules/Forum/Http/Controllers/ForumController.php:13
* @route '/api/v1/forums'
*/
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

/**
* @see \Modules\Forum\Http\Controllers\ForumController::index
* @see modules/Forum/Http/Controllers/ForumController.php:13
* @route '/api/v1/forums'
*/
const indexForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: index.url(options),
    method: 'get',
})

/**
* @see \Modules\Forum\Http\Controllers\ForumController::index
* @see modules/Forum/Http/Controllers/ForumController.php:13
* @route '/api/v1/forums'
*/
indexForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: index.url(options),
    method: 'get',
})

/**
* @see \Modules\Forum\Http\Controllers\ForumController::index
* @see modules/Forum/Http/Controllers/ForumController.php:13
* @route '/api/v1/forums'
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
* @see \Modules\Forum\Http\Controllers\ForumController::store
* @see modules/Forum/Http/Controllers/ForumController.php:29
* @route '/api/v1/forums'
*/
export const store = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

store.definition = {
    methods: ["post"],
    url: '/api/v1/forums',
} satisfies RouteDefinition<["post"]>

/**
* @see \Modules\Forum\Http\Controllers\ForumController::store
* @see modules/Forum/Http/Controllers/ForumController.php:29
* @route '/api/v1/forums'
*/
store.url = (options?: RouteQueryOptions) => {
    return store.definition.url + queryParams(options)
}

/**
* @see \Modules\Forum\Http\Controllers\ForumController::store
* @see modules/Forum/Http/Controllers/ForumController.php:29
* @route '/api/v1/forums'
*/
store.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

/**
* @see \Modules\Forum\Http\Controllers\ForumController::store
* @see modules/Forum/Http/Controllers/ForumController.php:29
* @route '/api/v1/forums'
*/
const storeForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: store.url(options),
    method: 'post',
})

/**
* @see \Modules\Forum\Http\Controllers\ForumController::store
* @see modules/Forum/Http/Controllers/ForumController.php:29
* @route '/api/v1/forums'
*/
storeForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: store.url(options),
    method: 'post',
})

store.form = storeForm

/**
* @see \Modules\Forum\Http\Controllers\ForumController::show
* @see modules/Forum/Http/Controllers/ForumController.php:34
* @route '/api/v1/forums/{forum}'
*/
export const show = (args: { forum: string | number } | [forum: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show.url(args, options),
    method: 'get',
})

show.definition = {
    methods: ["get","head"],
    url: '/api/v1/forums/{forum}',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \Modules\Forum\Http\Controllers\ForumController::show
* @see modules/Forum/Http/Controllers/ForumController.php:34
* @route '/api/v1/forums/{forum}'
*/
show.url = (args: { forum: string | number } | [forum: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { forum: args }
    }

    if (Array.isArray(args)) {
        args = {
            forum: args[0],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        forum: args.forum,
    }

    return show.definition.url
            .replace('{forum}', parsedArgs.forum.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \Modules\Forum\Http\Controllers\ForumController::show
* @see modules/Forum/Http/Controllers/ForumController.php:34
* @route '/api/v1/forums/{forum}'
*/
show.get = (args: { forum: string | number } | [forum: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show.url(args, options),
    method: 'get',
})

/**
* @see \Modules\Forum\Http\Controllers\ForumController::show
* @see modules/Forum/Http/Controllers/ForumController.php:34
* @route '/api/v1/forums/{forum}'
*/
show.head = (args: { forum: string | number } | [forum: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: show.url(args, options),
    method: 'head',
})

/**
* @see \Modules\Forum\Http\Controllers\ForumController::show
* @see modules/Forum/Http/Controllers/ForumController.php:34
* @route '/api/v1/forums/{forum}'
*/
const showForm = (args: { forum: string | number } | [forum: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: show.url(args, options),
    method: 'get',
})

/**
* @see \Modules\Forum\Http\Controllers\ForumController::show
* @see modules/Forum/Http/Controllers/ForumController.php:34
* @route '/api/v1/forums/{forum}'
*/
showForm.get = (args: { forum: string | number } | [forum: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: show.url(args, options),
    method: 'get',
})

/**
* @see \Modules\Forum\Http\Controllers\ForumController::show
* @see modules/Forum/Http/Controllers/ForumController.php:34
* @route '/api/v1/forums/{forum}'
*/
showForm.head = (args: { forum: string | number } | [forum: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
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
* @see \Modules\Forum\Http\Controllers\ForumController::update
* @see modules/Forum/Http/Controllers/ForumController.php:50
* @route '/api/v1/forums/{forum}'
*/
export const update = (args: { forum: string | number } | [forum: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})

update.definition = {
    methods: ["put","patch"],
    url: '/api/v1/forums/{forum}',
} satisfies RouteDefinition<["put","patch"]>

/**
* @see \Modules\Forum\Http\Controllers\ForumController::update
* @see modules/Forum/Http/Controllers/ForumController.php:50
* @route '/api/v1/forums/{forum}'
*/
update.url = (args: { forum: string | number } | [forum: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { forum: args }
    }

    if (Array.isArray(args)) {
        args = {
            forum: args[0],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        forum: args.forum,
    }

    return update.definition.url
            .replace('{forum}', parsedArgs.forum.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \Modules\Forum\Http\Controllers\ForumController::update
* @see modules/Forum/Http/Controllers/ForumController.php:50
* @route '/api/v1/forums/{forum}'
*/
update.put = (args: { forum: string | number } | [forum: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})

/**
* @see \Modules\Forum\Http\Controllers\ForumController::update
* @see modules/Forum/Http/Controllers/ForumController.php:50
* @route '/api/v1/forums/{forum}'
*/
update.patch = (args: { forum: string | number } | [forum: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'patch'> => ({
    url: update.url(args, options),
    method: 'patch',
})

/**
* @see \Modules\Forum\Http\Controllers\ForumController::update
* @see modules/Forum/Http/Controllers/ForumController.php:50
* @route '/api/v1/forums/{forum}'
*/
const updateForm = (args: { forum: string | number } | [forum: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: update.url(args, {
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'PUT',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'post',
})

/**
* @see \Modules\Forum\Http\Controllers\ForumController::update
* @see modules/Forum/Http/Controllers/ForumController.php:50
* @route '/api/v1/forums/{forum}'
*/
updateForm.put = (args: { forum: string | number } | [forum: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: update.url(args, {
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'PUT',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'post',
})

/**
* @see \Modules\Forum\Http\Controllers\ForumController::update
* @see modules/Forum/Http/Controllers/ForumController.php:50
* @route '/api/v1/forums/{forum}'
*/
updateForm.patch = (args: { forum: string | number } | [forum: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
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
* @see \Modules\Forum\Http\Controllers\ForumController::destroy
* @see modules/Forum/Http/Controllers/ForumController.php:55
* @route '/api/v1/forums/{forum}'
*/
export const destroy = (args: { forum: string | number } | [forum: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

destroy.definition = {
    methods: ["delete"],
    url: '/api/v1/forums/{forum}',
} satisfies RouteDefinition<["delete"]>

/**
* @see \Modules\Forum\Http\Controllers\ForumController::destroy
* @see modules/Forum/Http/Controllers/ForumController.php:55
* @route '/api/v1/forums/{forum}'
*/
destroy.url = (args: { forum: string | number } | [forum: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { forum: args }
    }

    if (Array.isArray(args)) {
        args = {
            forum: args[0],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        forum: args.forum,
    }

    return destroy.definition.url
            .replace('{forum}', parsedArgs.forum.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \Modules\Forum\Http\Controllers\ForumController::destroy
* @see modules/Forum/Http/Controllers/ForumController.php:55
* @route '/api/v1/forums/{forum}'
*/
destroy.delete = (args: { forum: string | number } | [forum: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

/**
* @see \Modules\Forum\Http\Controllers\ForumController::destroy
* @see modules/Forum/Http/Controllers/ForumController.php:55
* @route '/api/v1/forums/{forum}'
*/
const destroyForm = (args: { forum: string | number } | [forum: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: destroy.url(args, {
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'DELETE',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'post',
})

/**
* @see \Modules\Forum\Http\Controllers\ForumController::destroy
* @see modules/Forum/Http/Controllers/ForumController.php:55
* @route '/api/v1/forums/{forum}'
*/
destroyForm.delete = (args: { forum: string | number } | [forum: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: destroy.url(args, {
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'DELETE',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'post',
})

destroy.form = destroyForm

const forum = {
    index,
    store,
    show,
    update,
    destroy,
}

export default forum