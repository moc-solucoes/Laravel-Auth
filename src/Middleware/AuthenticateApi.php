<?php

namespace MOCSolutions\Auth\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use MOCSolutions\Auth\Models\Token;

class AuthenticateApi
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string|null $guard
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->bearerToken()) {
            $action = request()->route()->getActionMethod();
            $controller = explode('@', request()->route()->getAction()['controller'])[0];

            $comment = get_comments($controller, $action, "OpenPage");

            if (!$comment->quantity) {
                return return_json("Not Autorize.", null, true);
            }

            return $next($request);
        }

        $token = (new Token())->where("token", $request->bearerToken())->first();

        Auth::login($token->Usuario, true);

        if (!$token) return return_json("Token not exists.", null, true);

        $request->Token = $token;

        return $next($request);
    }
}
