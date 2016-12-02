<?php

namespace Joselfonseca\LaravelAdmin\Http\Middleware;

use Closure;
use Joselfonseca\LaravelAdmin\Entities\AppRequest;

/**
 * Class LogRequestsMiddleware
 * @package Joselfonseca\LaravelAdmin\Http\Middleware
 */
class LogRequestsMiddleware
{

    /**
     * @var
     */
    protected $type;

    /**
     * @param $request
     * @param Closure $next
     * @param null $type
     * @return mixed
     */
    public function handle($request, Closure $next, $type = null)
    {

        $this->type = $type;
        return $next($request);
    }

    /**
     * @param $request
     * @param $response
     */
    public function terminate($request, $response)
    {
        AppRequest::create([
            'type' => empty($this->type) ? 'api' : $this->type,
            'url' => $request->fullUrl(),
            'request_method' => $request->method(),
            'request_headers' => json_encode($request->headers->all()),
            'request_body' => $request->getContent(),
            'response_headers' => json_encode($response->headers->all()),
            'response_body' => $response->getContent(),
            'status_code' => $response->getStatusCode()
        ]);
    }

}