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
        $rols = $this->rolRepository->all();

        return $this->sendResponse($rols->toArray(), 'Roles recuperados con éxito');
    }

    /**
     * Store a newly created Rol in storage.
     * POST /rols
     *
     * @param CreateRolAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateRolAPIRequest $request)
    {
        $input = $request->all();

        $rol = $this->rolRepository->create($input);

        return $this->sendResponse($rol->toArray(), 'Rol guardado con éxito');
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

        return $this->sendResponse($rol->toArray(), 'Rol recuperado con éxito');
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
    public function update($id, UpdateRolAPIRequest $request)
    {
        $input = $request->all();

        /** @var Rol $rol */
        $rol = $this->rolRepository->findWithoutFail($id);

        if (empty($rol)) {
            return $this->sendError('Rol no encontrado');
        }

        $rol = $this->rolRepository->update($input, $id);

        return $this->sendResponse($rol->toArray(), 'Rol actualizado con éxito');
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
