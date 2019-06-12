<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateEntidadAPIRequest;
use App\Http\Requests\API\UpdateEntidadAPIRequest;
use App\Models\Entidad;
use App\Repositories\EntidadRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class EntidadController
 * @package App\Http\Controllers\API
 */

class EntidadAPIController extends AppBaseController
{
    /** @var  EntidadRepository */
    private $entidadRepository;

    public function __construct(EntidadRepository $entidadRepo)
    {
        $this->entidadRepository = $entidadRepo;
    }

    /**
     * Display a listing of the Entidad.
     * GET|HEAD /entidads
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->authorize('view', 'App\Entidad');
        $this->entidadRepository->pushCriteria(new RequestCriteria($request));
        $this->entidadRepository->pushCriteria(new LimitOffsetCriteria($request));
        $entidads = $this->entidadRepository->all();

        return $this->sendResponse($entidads->toArray(), 'Entidads retrieved successfully');
    }

    /**
     * Store a newly created Entidad in storage.
     * POST /entidads
     *
     * @param CreateEntidadAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateEntidadAPIRequest $request)
    {
        $this->authorize('create', 'App\Entidad');
        $input = $request->all();

        $entidad = $this->entidadRepository->create($input);

        return $this->sendResponse($entidad->toArray(), 'Entidad saved successfully');
    }

    /**
     * Display the specified Entidad.
     * GET|HEAD /entidads/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $this->authorize('view', 'App\Entidad');
        /** @var Entidad $entidad */
        $entidad = $this->entidadRepository->findWithoutFail($id);

        if (empty($entidad)) {
            return $this->sendError('Entidad not found');
        }

        return $this->sendResponse($entidad->toArray(), 'Entidad retrieved successfully');
    }

    /**
     * Update the specified Entidad in storage.
     * PUT/PATCH /entidads/{id}
     *
     * @param  int $id
     * @param UpdateEntidadAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEntidadAPIRequest $request)
    {
        $this->authorize('update', 'App\Entidad');
        $input = $request->all();

        /** @var Entidad $entidad */
        $entidad = $this->entidadRepository->findWithoutFail($id);

        if (empty($entidad)) {
            return $this->sendError('Entidad not found');
        }

        $entidad = $this->entidadRepository->update($input, $id);

        return $this->sendResponse($entidad->toArray(), 'Entidad updated successfully');
    }

    /**
     * Remove the specified Entidad from storage.
     * DELETE /entidads/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $this->authorize('delete', 'App\Entidad');
        /** @var Entidad $entidad */
        $entidad = $this->entidadRepository->findWithoutFail($id);

        if (empty($entidad)) {
            return $this->sendError('Entidad not found');
        }

        $entidad->delete();

        return $this->sendResponse($id, 'Entidad deleted successfully');
    }
}
