<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PermissionAuthorization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$permissions)
    {
        if ($request->user()->hasPermission($permissions)) {
            return $next($request);
        }
        return redirect(route('denies'));
    }
}
