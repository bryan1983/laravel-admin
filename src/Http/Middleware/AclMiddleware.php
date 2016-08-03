<?php

namespace Joselfonseca\LaravelAdmin\Http\Middleware;

use Auth;
use Closure;

/**
 * Class AclMiddleware
 * @package Joselfonseca\LaravelAdmin\Http\Middleware
 */
class AclMiddleware
{

    /**
     * @param $request
     * @param Closure $next
     * @param $permissions
     * @return mixed
     */
    public function handle($request, Closure $next, $permissions)
    {
        $perms = explode(',', $permissions);
        $user = Auth::user();
        if (!$user->can($perms)) {
            abort(403, 'Unauthorized action.');
        }
        return $next($request);
    }
}
