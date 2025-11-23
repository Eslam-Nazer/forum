import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition, applyUrlDefaults } from './../../../../../../wayfinder'
/**
* @see \Modules\Forum\Http\Controllers\Users\UserController::show
* @see modules/Forum/Http/Controllers/Users/UserController.php:29
* @route '/{name}/profile'
*/
export const show = (args: { name: string | number } | [name: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show.url(args, options),
    method: 'get',
})

show.definition = {
    methods: ["get","head"],
    url: '/{name}/profile',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \Modules\Forum\Http\Controllers\Users\UserController::show
* @see modules/Forum/Http/Controllers/Users/UserController.php:29
* @route '/{name}/profile'
*/
show.url = (args: { name: string | number } | [name: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { name: args }
    }

    if (Array.isArray(args)) {
        args = {
            name: args[0],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        name: args.name,
    }

    return show.definition.url
            .replace('{name}', parsedArgs.name.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \Modules\Forum\Http\Controllers\Users\UserController::show
* @see modules/Forum/Http/Controllers/Users/UserController.php:29
* @route '/{name}/profile'
*/
show.get = (args: { name: string | number } | [name: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show.url(args, options),
    method: 'get',
})

/**
* @see \Modules\Forum\Http\Controllers\Users\UserController::show
* @see modules/Forum/Http/Controllers/Users/UserController.php:29
* @route '/{name}/profile'
*/
show.head = (args: { name: string | number } | [name: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: show.url(args, options),
    method: 'head',
})

/**
* @see \Modules\Forum\Http\Controllers\Users\UserController::show
* @see modules/Forum/Http/Controllers/Users/UserController.php:29
* @route '/{name}/profile'
*/
const showForm = (args: { name: string | number } | [name: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: show.url(args, options),
    method: 'get',
})

/**
* @see \Modules\Forum\Http\Controllers\Users\UserController::show
* @see modules/Forum/Http/Controllers/Users/UserController.php:29
* @route '/{name}/profile'
*/
showForm.get = (args: { name: string | number } | [name: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: show.url(args, options),
    method: 'get',
})

/**
* @see \Modules\Forum\Http\Controllers\Users\UserController::show
* @see modules/Forum/Http/Controllers/Users/UserController.php:29
* @route '/{name}/profile'
*/
showForm.head = (args: { name: string | number } | [name: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: show.url(args, {
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'HEAD',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'get',
})

show.form = showForm

const UserController = { show }

export default UserController