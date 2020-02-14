<?php

namespace MOCSolutions\Auth\Middleware;

use Closure;
use Illuminate\Http\Request;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  string|null $guard
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!user()) {
            $action = request()->route()->getActionMethod();
            $controller = explode('@', request()->route()->getAction()['controller'])[0];

            $comment = get_comments($controller, $action, "OpenPage");

            if (!$comment->quantity) {
                return redirect()->route('login');
            }
        }

        return $next($request);
    }
}
