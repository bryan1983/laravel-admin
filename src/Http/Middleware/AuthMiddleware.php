<?php

namespace Joselfonseca\LaravelAdmin\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

/**
 * Class AuthMiddleware
 * @package Joselfonseca\LaravelAdmin\Http\Middleware
 */
class AuthMiddleware
{


    /**
     * @var Guard
     */
    protected $auth;


    /**
     * AuthMiddleware constructor.
     * @param Guard $auth
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * @param $request
     * @param Closure $next
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function handle($request, Closure $next)
    {
        if ($this->auth->guest()) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest(config('laravel-admin.routePrefix', 'backend').'/login');
            }
        }

        return $next($request);
    }
}
