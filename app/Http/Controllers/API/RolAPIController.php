<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateRolAPIRequest;
use App\Http\Requests\API\UpdateRolAPIRequest;
use Spatie\Permission\Models\Role;
use App\Repositories\RolRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Spatie\Permission\Models\Permission;

/**
 * Class RolController
 * @package App\Http\Controllers\API
 */

class RolAPIController extends AppBaseController
{
    /** @var  RolRepository */
    private $rolRepository;

    public function __construct(RolRepository $rolRepo)
    {
        $this->rolRepository = $rolRepo;
    }

    /**
     * Display a listing of the Rol.
     * GET|HEAD /rols
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->rolRepository->pushCriteria(new RequestCriteria($request));
        $this->rolRepository->pushCriteria(new LimitOffsetCriteria($request));
        $rols = $this->rolRepository->withCount('users')->all();

        return $this->sendResponse($rols->toArray(), 'Roles recuperados con éxito');
    }

    public function indexPermissions(Request $request)
    {
        $data['allPermissions'] = Permission::get();
        if (!empty($request->get('inheritFromRole'))) {
            $data['selectedPermissions'] = $this->rolRepository->find($request->get('inheritFromRole'))->permissions()->get();
            $data['allPermissions'] = $data['allPermissions']->diff($data['selectedPermissions']);

            $data['selectedPermissions'] = $this->rolRepository->nameChangedPermissions($data['selectedPermissions']);
        }
        $data['allPermissions'] = $this->rolRepository->nameChangedPermissions($data['allPermissions']);

        return $this->sendResponse($data, "get permissions ok.");
    }

    /**
     * Store a newly created Rol in storage.
     * POST /rols
     *
     * @param CreateRolAPIRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $validate = validator($input, [
            'name' => 'required|unique:roles',
            'permisos' => 'required|array'
        ]);
        if ($validate->fails()) return $this->sendError($validate->errors()->first());

        $rol = $this->rolRepository->create([
            'name' => $input['name']
        ]);
        $rol->syncPermissions(array_pluck($input['permisos'], 'id'));

        return $this->sendResponse([], 'Rol guardado con éxito');
    }

    /**
     * Display the specified Rol.
     * GET|HEAD /rols/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Rol $rol */
        $rol = $this->rolRepository->findWithoutFail($id);

        if (empty($rol)) {
            return $this->sendError('Rol no encontrado');
        }

        $data['allPermissions'] = Permission::get();
        $data['selectedPermissions'] = $rol->permissions()->get();
        $data['allPermissions'] = $data['allPermissions']->diff($data['selectedPermissions']);

        $data['selectedPermissions'] = $this->rolRepository->nameChangedPermissions($data['selectedPermissions']);
        $data['allPermissions'] = $this->rolRepository->nameChangedPermissions($data['allPermissions']);

        $rol = [
            'name' => $rol->name,
            'selectedPermissions' => $data['selectedPermissions'],
            'allPermissions' => $data['allPermissions']
        ];

        return $this->sendResponse($rol, 'Rol recuperado con éxito');
    }

    /**
     * Update the specified Rol in storage.
     * PUT/PATCH /rols/{id}
     *
     * @param  int $id
     * @param UpdateRolAPIRequest $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $input = $request->all();

        $validate = validator($input, [
            'name' => 'required',
            'permisos' => 'required|array'
        ]);
        if ($validate->fails()) return $this->sendError($validate->errors()->first());

        /** @var Rol $rol */
        $rol = $this->rolRepository->findWithoutFail($id);

        if (empty($rol)) {
            return $this->sendError('Rol no encontrado');
        }

        if (!unique('roles', $id, 'name', $input['name'])) {
            return $this->sendError("El nombre tiene que ser único");
        }

        $rol->name = $input['name'];
        $rol->save();

        $rol->syncPermissions(Permission::find(array_pluck($input['permisos'], 'id')));

        return $this->sendResponse([], 'Rol actualizado con éxito');
    }

    /**
     * Remove the specified Rol from storage.
     * DELETE /rols/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Rol $rol */
        $rol = $this->rolRepository->findWithoutFail($id);

        if (empty($rol)) {
            return $this->sendError('Rol no encontrado');
        }

        $rol->delete();

        return $this->sendResponse($id, 'Rol eliminado con éxito');
    }
}
