<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    // app/Http/Middleware/CheckRole.php

    public function handle(Request $request, Closure $next, $role)
    {
//        dd($role);
        $routeName = $request->route()->getName();

        $openRoutes = [
            'home',
            'login',
            'register',
        ];

        if (in_array($routeName, $openRoutes)) {
            return $next($request);
        }

        if (!$request->user() || $request->user()->role !== $role) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }

}
