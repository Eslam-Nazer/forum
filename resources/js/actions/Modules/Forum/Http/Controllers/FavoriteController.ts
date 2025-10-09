import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition, applyUrlDefaults } from './../../../../../wayfinder'
/**
* @see \Modules\Forum\Http\Controllers\FavoriteController::store
* @see modules/Forum/Http/Controllers/FavoriteController.php:27
* @route '/favorites/{type}/{id}'
*/
export const store = (args: { type: string | number, id: string | number } | [type: string | number, id: string | number ], options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(args, options),
    method: 'post',
})

store.definition = {
    methods: ["post"],
    url: '/favorites/{type}/{id}',
} satisfies RouteDefinition<["post"]>

/**
* @see \Modules\Forum\Http\Controllers\FavoriteController::store
* @see modules/Forum/Http/Controllers/FavoriteController.php:27
* @route '/favorites/{type}/{id}'
*/
store.url = (args: { type: string | number, id: string | number } | [type: string | number, id: string | number ], options?: RouteQueryOptions) => {
    if (Array.isArray(args)) {
        args = {
            type: args[0],
            id: args[1],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        type: args.type,
        id: args.id,
    }

    return store.definition.url
            .replace('{type}', parsedArgs.type.toString())
            .replace('{id}', parsedArgs.id.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \Modules\Forum\Http\Controllers\FavoriteController::store
* @see modules/Forum/Http/Controllers/FavoriteController.php:27
* @route '/favorites/{type}/{id}'
*/
store.post = (args: { type: string | number, id: string | number } | [type: string | number, id: string | number ], options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(args, options),
    method: 'post',
})

/**
* @see \Modules\Forum\Http\Controllers\FavoriteController::store
* @see modules/Forum/Http/Controllers/FavoriteController.php:27
* @route '/favorites/{type}/{id}'
*/
const storeForm = (args: { type: string | number, id: string | number } | [type: string | number, id: string | number ], options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: store.url(args, options),
    method: 'post',
})

/**
* @see \Modules\Forum\Http\Controllers\FavoriteController::store
* @see modules/Forum/Http/Controllers/FavoriteController.php:27
* @route '/favorites/{type}/{id}'
*/
storeForm.post = (args: { type: string | number, id: string | number } | [type: string | number, id: string | number ], options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: store.url(args, options),
    method: 'post',
})

store.form = storeForm

/**
* @see \Modules\Forum\Http\Controllers\FavoriteController::destroy
* @see modules/Forum/Http/Controllers/FavoriteController.php:40
* @route '/favorites/{type}/{id}'
*/
export const destroy = (args: { type: string | number, id: string | number } | [type: string | number, id: string | number ], options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

destroy.definition = {
    methods: ["delete"],
    url: '/favorites/{type}/{id}',
} satisfies RouteDefinition<["delete"]>

/**
* @see \Modules\Forum\Http\Controllers\FavoriteController::destroy
* @see modules/Forum/Http/Controllers/FavoriteController.php:40
* @route '/favorites/{type}/{id}'
*/
destroy.url = (args: { type: string | number, id: string | number } | [type: string | number, id: string | number ], options?: RouteQueryOptions) => {
    if (Array.isArray(args)) {
        args = {
            type: args[0],
            id: args[1],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        type: args.type,
        id: args.id,
    }

    return destroy.definition.url
            .replace('{type}', parsedArgs.type.toString())
            .replace('{id}', parsedArgs.id.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \Modules\Forum\Http\Controllers\FavoriteController::destroy
* @see modules/Forum/Http/Controllers/FavoriteController.php:40
* @route '/favorites/{type}/{id}'
*/
destroy.delete = (args: { type: string | number, id: string | number } | [type: string | number, id: string | number ], options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

/**
* @see \Modules\Forum\Http\Controllers\FavoriteController::destroy
* @see modules/Forum/Http/Controllers/FavoriteController.php:40
* @route '/favorites/{type}/{id}'
*/
const destroyForm = (args: { type: string | number, id: string | number } | [type: string | number, id: string | number ], options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: destroy.url(args, {
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'DELETE',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'post',
})

/**
* @see \Modules\Forum\Http\Controllers\FavoriteController::destroy
* @see modules/Forum/Http/Controllers/FavoriteController.php:40
* @route '/favorites/{type}/{id}'
*/
destroyForm.delete = (args: { type: string | number, id: string | number } | [type: string | number, id: string | number ], options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: destroy.url(args, {
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'DELETE',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'post',
})

destroy.form = destroyForm

const FavoriteController = { store, destroy }

export default FavoriteController