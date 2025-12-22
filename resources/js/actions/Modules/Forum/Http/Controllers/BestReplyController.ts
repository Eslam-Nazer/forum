import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition, applyUrlDefaults } from './../../../../../wayfinder'
/**
* @see \Modules\Forum\Http\Controllers\BestReplyController::store
* @see modules/Forum/Http/Controllers/BestReplyController.php:17
* @route '/replies/{id}/best'
*/
export const store = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(args, options),
    method: 'post',
})

store.definition = {
    methods: ["post"],
    url: '/replies/{id}/best',
} satisfies RouteDefinition<["post"]>

/**
* @see \Modules\Forum\Http\Controllers\BestReplyController::store
* @see modules/Forum/Http/Controllers/BestReplyController.php:17
* @route '/replies/{id}/best'
*/
store.url = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions) => {
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

    return store.definition.url
            .replace('{id}', parsedArgs.id.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \Modules\Forum\Http\Controllers\BestReplyController::store
* @see modules/Forum/Http/Controllers/BestReplyController.php:17
* @route '/replies/{id}/best'
*/
store.post = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(args, options),
    method: 'post',
})

/**
* @see \Modules\Forum\Http\Controllers\BestReplyController::store
* @see modules/Forum/Http/Controllers/BestReplyController.php:17
* @route '/replies/{id}/best'
*/
const storeForm = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: store.url(args, options),
    method: 'post',
})

/**
* @see \Modules\Forum\Http\Controllers\BestReplyController::store
* @see modules/Forum/Http/Controllers/BestReplyController.php:17
* @route '/replies/{id}/best'
*/
storeForm.post = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: store.url(args, options),
    method: 'post',
})

store.form = storeForm

/**
* @see \Modules\Forum\Http\Controllers\BestReplyController::update
* @see modules/Forum/Http/Controllers/BestReplyController.php:29
* @route '/replies/{id}/best'
*/
export const update = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'patch'> => ({
    url: update.url(args, options),
    method: 'patch',
})

update.definition = {
    methods: ["patch"],
    url: '/replies/{id}/best',
} satisfies RouteDefinition<["patch"]>

/**
* @see \Modules\Forum\Http\Controllers\BestReplyController::update
* @see modules/Forum/Http/Controllers/BestReplyController.php:29
* @route '/replies/{id}/best'
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
* @see \Modules\Forum\Http\Controllers\BestReplyController::update
* @see modules/Forum/Http/Controllers/BestReplyController.php:29
* @route '/replies/{id}/best'
*/
update.patch = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'patch'> => ({
    url: update.url(args, options),
    method: 'patch',
})

/**
* @see \Modules\Forum\Http\Controllers\BestReplyController::update
* @see modules/Forum/Http/Controllers/BestReplyController.php:29
* @route '/replies/{id}/best'
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
* @see \Modules\Forum\Http\Controllers\BestReplyController::update
* @see modules/Forum/Http/Controllers/BestReplyController.php:29
* @route '/replies/{id}/best'
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
* @see \Modules\Forum\Http\Controllers\BestReplyController::destroy
* @see modules/Forum/Http/Controllers/BestReplyController.php:39
* @route '/replies/{id}/best'
*/
export const destroy = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

destroy.definition = {
    methods: ["delete"],
    url: '/replies/{id}/best',
} satisfies RouteDefinition<["delete"]>

/**
* @see \Modules\Forum\Http\Controllers\BestReplyController::destroy
* @see modules/Forum/Http/Controllers/BestReplyController.php:39
* @route '/replies/{id}/best'
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
* @see \Modules\Forum\Http\Controllers\BestReplyController::destroy
* @see modules/Forum/Http/Controllers/BestReplyController.php:39
* @route '/replies/{id}/best'
*/
destroy.delete = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

/**
* @see \Modules\Forum\Http\Controllers\BestReplyController::destroy
* @see modules/Forum/Http/Controllers/BestReplyController.php:39
* @route '/replies/{id}/best'
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
* @see \Modules\Forum\Http\Controllers\BestReplyController::destroy
* @see modules/Forum/Http/Controllers/BestReplyController.php:39
* @route '/replies/{id}/best'
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

const BestReplyController = { store, update, destroy }

export default BestReplyController