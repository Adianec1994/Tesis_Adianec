<?php

namespace App\Http\Middleware;

use Spatie\Permission\Models\Permission;
use Auth;
use Closure;

class SendPermissions
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
        $response = $next($request);
        if (
            get_class($response) !== "Symfony\Component\HttpFoundation\BinaryFileResponse"
            && !$request->is('register') && !$request->is('login')
        ) {
            $response->header('permissions', $this->permissions());
        }

        return $response;
    }

    private function permissions()
    {
        $permissions = (auth()->check()) ? (auth()->user()->isSuperUser()) ? Permission::all()->pluck('name') : auth()->user()->getAllPermissions()->pluck('name') : [];
        $response = [];
        foreach ($permissions as $value) {
            list($permission, $model) = explode("_", $value, 2);
            $model .= '-' . $permission;
            $response[$model] = true;
        }
        return json_encode($response);
    }
}
