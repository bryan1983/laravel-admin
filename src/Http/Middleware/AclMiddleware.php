<?php


namespace Joselfonseca\LaravelAdmin\Http\Middleware;

use Closure;

class AclMiddleware {

    /**
     * Run the request filter.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle($request, Closure $next, $permissions)
    {
        $perms = explode(',',$permissions);
        $user = \Auth::user();
        if(!$user->can($perms)){
            return redirect()->to('unauthorized');
        }
        return $next($request);
    }

}