<?php

namespace Bantenprov\PerijinanSatuPintu\Http\Middleware;

use Closure;

/**
 * The PerijinanSatuPintuMiddleware class.
 *
 * @package Bantenprov\PerijinanSatuPintu
 * @author  bantenprov <developer.bantenprov@gmail.com>
 */
class PerijinanSatuPintuMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        return $next($request);
    }
}
