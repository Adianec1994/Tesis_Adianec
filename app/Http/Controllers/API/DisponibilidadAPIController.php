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
        $this->disponibilidadRepository->pushCriteria(new RequestCriteria($request));
        $this->disponibilidadRepository->pushCriteria(new LimitOffsetCriteria($request));
        $disponibilidads = $this->disponibilidadRepository->all();

        return $this->sendResponse($disponibilidads->toArray(), 'Disponibilidads retrieved successfully');
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
        $input = $request->all();

        $disponibilidad = $this->disponibilidadRepository->create($input);

        return $this->sendResponse($disponibilidad->toArray(), 'Disponibilidad saved successfully');
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
        /** @var Disponibilidad $disponibilidad */
        $disponibilidad = $this->disponibilidadRepository->findWithoutFail($id);

        if (empty($disponibilidad)) {
            return $this->sendError('Disponibilidad not found');
        }

        return $this->sendResponse($disponibilidad->toArray(), 'Disponibilidad retrieved successfully');
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
        $input = $request->all();

        /** @var Disponibilidad $disponibilidad */
        $disponibilidad = $this->disponibilidadRepository->findWithoutFail($id);

        if (empty($disponibilidad)) {
            return $this->sendError('Disponibilidad not found');
        }

        $disponibilidad = $this->disponibilidadRepository->update($input, $id);

        return $this->sendResponse($disponibilidad->toArray(), 'Disponibilidad updated successfully');
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
        /** @var Disponibilidad $disponibilidad */
        $disponibilidad = $this->disponibilidadRepository->findWithoutFail($id);

        if (empty($disponibilidad)) {
            return $this->sendError('Disponibilidad not found');
        }

        $disponibilidad->delete();

        return $this->sendResponse($id, 'Disponibilidad deleted successfully');
    }
}
