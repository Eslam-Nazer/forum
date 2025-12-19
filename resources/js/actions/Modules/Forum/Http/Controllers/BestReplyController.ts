import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition, applyUrlDefaults } from './../../../../../wayfinder'
/**
* @see \Modules\Forum\Http\Controllers\BestReplyController::store
* @see modules/Forum/Http/Controllers/BestReplyController.php:15
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
* @see modules/Forum/Http/Controllers/BestReplyController.php:15
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
* @see modules/Forum/Http/Controllers/BestReplyController.php:15
* @route '/replies/{id}/best'
*/
store.post = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(args, options),
    method: 'post',
})

/**
* @see \Modules\Forum\Http\Controllers\BestReplyController::store
* @see modules/Forum/Http/Controllers/BestReplyController.php:15
* @route '/replies/{id}/best'
*/
const storeForm = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: store.url(args, options),
    method: 'post',
})

/**
* @see \Modules\Forum\Http\Controllers\BestReplyController::store
* @see modules/Forum/Http/Controllers/BestReplyController.php:15
* @route '/replies/{id}/best'
*/
storeForm.post = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: store.url(args, options),
    method: 'post',
})

store.form = storeForm

const BestReplyController = { store }

export default BestReplyController