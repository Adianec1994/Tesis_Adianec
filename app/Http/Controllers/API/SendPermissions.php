<?php

namespace App\Http\Controllers\API;

use Spatie\Permission\Models\Permission;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;

class SendPermissions extends AppBaseController
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $permissions = (auth()->check()) ? (auth()->user()->isSuperUser()) ? Permission::all()->pluck('name') : auth()->user()->getAllPermissions()->pluck('name') : [];
        $response = [];
        foreach ($permissions as $value) {
            list($permission, $model) = explode("_", $value, 2);
            $model .= '-' . $permission;
            $response[$model] = true;
        }
        // dd(json_encode($response));
        return json_encode($response);
    }
}
