import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition, applyUrlDefaults } from './../../../../../wayfinder'
/**
* @see \Modules\Forum\Http\Controllers\FavoriteController::store
* @see modules/Forum/Http/Controllers/FavoriteController.php:41
* @route '/{type}/{id}/favorites'
*/
export const store = (args: { type: string | number, id: string | number } | [type: string | number, id: string | number ], options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(args, options),
    method: 'post',
})

store.definition = {
    methods: ["post"],
    url: '/{type}/{id}/favorites',
} satisfies RouteDefinition<["post"]>

/**
* @see \Modules\Forum\Http\Controllers\FavoriteController::store
* @see modules/Forum/Http/Controllers/FavoriteController.php:41
* @route '/{type}/{id}/favorites'
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
* @see modules/Forum/Http/Controllers/FavoriteController.php:41
* @route '/{type}/{id}/favorites'
*/
store.post = (args: { type: string | number, id: string | number } | [type: string | number, id: string | number ], options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(args, options),
    method: 'post',
})

/**
* @see \Modules\Forum\Http\Controllers\FavoriteController::store
* @see modules/Forum/Http/Controllers/FavoriteController.php:41
* @route '/{type}/{id}/favorites'
*/
const storeForm = (args: { type: string | number, id: string | number } | [type: string | number, id: string | number ], options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: store.url(args, options),
    method: 'post',
})

/**
* @see \Modules\Forum\Http\Controllers\FavoriteController::store
* @see modules/Forum/Http/Controllers/FavoriteController.php:41
* @route '/{type}/{id}/favorites'
*/
storeForm.post = (args: { type: string | number, id: string | number } | [type: string | number, id: string | number ], options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: store.url(args, options),
    method: 'post',
})

store.form = storeForm

const FavoriteController = { store }

export default FavoriteController