<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateMantenimientoAPIRequest;
use App\Http\Requests\API\UpdateMantenimientoAPIRequest;
use App\Models\Mantenimiento;
use App\Repositories\MantenimientoRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class MantenimientosAPIController extends AppBaseController
{
    /** @var  MantenimientoRepository */
    private $mantenimientoRepository;

    public function __construct(MantenimientoRepository $mantenimientoRepo)
    {
        $this->mantenimientoRepository = $mantenimientoRepo;
    }

    /**
     * Display a listing of the Generacion.
     * GET|HEAD /generacions
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->authorize('view', 'App\Mantenimiento');

        $this->mantenimientoRepository->pushCriteria(new RequestCriteria($request));
        $this->mantenimientoRepository->pushCriteria(new LimitOffsetCriteria($request));
        $mantenimientos = $this->mantenimientoRepository->all();

        return $this->sendResponse($mantenimientos->toArray(), 'Mantenimiento recuperado con éxito');
    }

    /**
     * Store a newly created Generacion in storage.
     * POST /generacions
     *
     * @param CreateMantenimientoAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateMantenimientoAPIRequest $request)
    {
        $this->authorize('create', 'App\Mantenimiento');

        $input = $request->all();

        $mantenimiento = $this->mantenimientoRepository->create($input);

        return $this->sendResponse($mantenimiento->toArray(), 'Mantenimiento guardado con éxito');
    }

    /**
     * Display the specified Mantenimiento.
     * GET|HEAD /mantenimientos/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $this->authorize('view', 'App\Mantenimiento');

        /** @var Mantenimiento $mantenimiento */
        $mantenimiento = $this->mantenimientoRepository->findWithoutFail($id);

        if (empty($mantenimiento)) {
            return $this->sendError('Mantenimiento no encontrado');
        }

        return $this->sendResponse($mantenimiento->toArray(), 'Mantenimiento recuperado con éxito');
    }

    /**
     * Update the specified Mantenimiento in storage.
     * PUT/PATCH /mantenimientos/{id}
     *
     * @param  int $id
     * @param UpdateMantenimientoAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMantenimientoAPIRequest $request)
    {
        $this->authorize('update', 'App\Mantenimiento');

        $input = $request->all();

        /** @var Mantenimiento $mantenimiento */
        $mantenimiento = $this->mantenimientoRepository->findWithoutFail($id);

        if (empty($mantenimiento)) {
            return $this->sendError('Mantenimiento no encontrado');
        }

        $mantenimiento = $this->mantenimientoRepository->update($input, $id);

        return $this->sendResponse($mantenimiento->toArray(), 'Mantenimiento actualizado con éxito');
    }

    /**
     * Remove the specified Mantenimiento from storage.
     * DELETE /mantenimientos/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $this->authorize('delete', 'App\Mantenimiento');

        /** @var Mantenimiento $mantenimiento */
        $mantenimiento = $this->mantenimientoRepository->findWithoutFail($id);

        if (empty($mantenimiento)) {
            return $this->sendError('Mantenimiento no encontrado');
        }

        $mantenimiento->delete();

        return $this->sendResponse($id, 'Mantenimiento eliminado con éxito');
    }
}
