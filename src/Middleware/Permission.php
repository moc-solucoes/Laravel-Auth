<?php

namespace MOCSolutions\Auth\Middleware;

use Closure;
use Illuminate\Http\Request;

class Permission
{
    /**
     * Create a new middleware instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle an incoming request.
     *
     * @param $request
     * @param Closure $next
     * @param null $guard
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $action = $request->route()->getActionMethod();

        $controller = explode('@', $request->route()->getAction()['controller'])[0];

        $comment = get_comments($controller, $action, "Permission");

        if ($comment->quantity > 0) {
            // Possui permissões
            if (!$comment->option) {
                $permission_name = $controller . "@" . $action;
                $permission_name = explode("\\", $permission_name);
                $permission_name = end($permission_name);
            } else {
                $permission_name = $comment->option;
            }

            if (user()) {
                if (!hasPermission($permission_name)) {
                    return $request->isXmlHttpRequest() ?
                        return_json("Usuário não possui permissões para efetuar esta ação.", [], true) :
                        redirect()->route('auth.admin.error.401');
                }
            } else {
                return return_json("Usuário não está logado para efetuar esta ação.", [], true);
            }

        }

        return $next($request);
    }


}
