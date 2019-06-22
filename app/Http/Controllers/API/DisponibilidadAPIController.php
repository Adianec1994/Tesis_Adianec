<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateDisponibilidadAPIRequest;
use App\Http\Requests\API\UpdateDisponibilidadAPIRequest;
use App\Models\Disponibilidad;
use App\Repositories\DisponibilidadRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class DisponibilidadController
 * @package App\Http\Controllers\API
 */

class DisponibilidadAPIController extends AppBaseController
{
    /** @var  DisponibilidadRepository */
    private $disponibilidadRepository;

    public function __construct(DisponibilidadRepository $disponibilidadRepo)
    {
        $this->disponibilidadRepository = $disponibilidadRepo;
    }

    /**
     * Display a listing of the Disponibilidad.
     * GET|HEAD /disponibilidads
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->authorize('view', 'App\Disponibilidad');

        $this->disponibilidadRepository->pushCriteria(new RequestCriteria($request));
        $this->disponibilidadRepository->pushCriteria(new LimitOffsetCriteria($request));
        $disponibilidads = $this->disponibilidadRepository->all();

        return $this->sendResponse($disponibilidads->toArray(), 'Disponibilidad recuperado con éxito');
    }

    /**
     * Store a newly created Disponibilidad in storage.
     * POST /disponibilidads
     *
     * @param CreateDisponibilidadAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateDisponibilidadAPIRequest $request)
    {
        $this->authorize('create', 'App\Disponibilidad');

        $input = $request->all();

        $disponibilidad = $this->disponibilidadRepository->create($input);

        return $this->sendResponse($disponibilidad->toArray(), 'Disponibilidad guardado con éxito');
    }

    /**
     * Display the specified Disponibilidad.
     * GET|HEAD /disponibilidads/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $this->authorize('view', 'App\Disponibilidad');

        /** @var Disponibilidad $disponibilidad */
        $disponibilidad = $this->disponibilidadRepository->findWithoutFail($id);

        if (empty($disponibilidad)) {
            return $this->sendError('Disponibilidad no encontrado');
        }

        return $this->sendResponse($disponibilidad->toArray(), 'Disponibilidad recuperado con éxito');
    }

    /**
     * Update the specified Disponibilidad in storage.
     * PUT/PATCH /disponibilidads/{id}
     *
     * @param  int $id
     * @param UpdateDisponibilidadAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDisponibilidadAPIRequest $request)
    {
        $this->authorize('update', 'App\Disponibilidad');

        $input = $request->all();

        /** @var Disponibilidad $disponibilidad */
        $disponibilidad = $this->disponibilidadRepository->findWithoutFail($id);

        if (empty($disponibilidad)) {
            return $this->sendError('Disponibilidad no encontrado');
        }

        $disponibilidad = $this->disponibilidadRepository->update($input, $id);

        return $this->sendResponse($disponibilidad->toArray(), 'Disponibilidad actualizado con éxito');
    }

    /**
     * Remove the specified Disponibilidad from storage.
     * DELETE /disponibilidads/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $this->authorize('delete', 'App\Disponibilidad');

        /** @var Disponibilidad $disponibilidad */
        $disponibilidad = $this->disponibilidadRepository->findWithoutFail($id);

        if (empty($disponibilidad)) {
            return $this->sendError('Disponibilidad no encontrado');
        }

        $disponibilidad->delete();

        return $this->sendResponse($id, 'Disponibilidad eliminado con éxito');
    }
}
