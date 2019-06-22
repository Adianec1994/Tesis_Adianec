<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCoberturaCombustibleAPIRequest;
use App\Http\Requests\API\UpdateCoberturaCombustibleAPIRequest;
use App\Models\CoberturaCombustible;
use App\Repositories\CoberturaCombustibleRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class CoberturaCombustibleController
 * @package App\Http\Controllers\API
 */

class CoberturaCombustibleAPIController extends AppBaseController
{
    /** @var  CoberturaCombustibleRepository */
    private $coberturaCombustibleRepository;

    public function __construct(CoberturaCombustibleRepository $coberturaCombustibleRepo)
    {
        $this->coberturaCombustibleRepository = $coberturaCombustibleRepo;
    }

    /**
     * Display a listing of the CoberturaCombustible.
     * GET|HEAD /coberturaCombustibles
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->authorize('view', 'App\CoberturaCombustible');

        $this->coberturaCombustibleRepository->pushCriteria(new RequestCriteria($request));
        $this->coberturaCombustibleRepository->pushCriteria(new LimitOffsetCriteria($request));
        $coberturaCombustibles = $this->coberturaCombustibleRepository->all();

        return $this->sendResponse($coberturaCombustibles->toArray(), 'Coberturas de Combustibles recuperado con éxito');
    }

    /**
     * Store a newly created CoberturaCombustible in storage.
     * POST /coberturaCombustibles
     *
     * @param CreateCoberturaCombustibleAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateCoberturaCombustibleAPIRequest $request)
    {
        $this->authorize('create', 'App\CoberturaCombustible');

        $input = $request->all();

        $coberturaCombustible = $this->coberturaCombustibleRepository->create($input);

        return $this->sendResponse($coberturaCombustible->toArray(), 'Cobertura de Combustible guardado con éxito');
    }

    /**
     * Display the specified CoberturaCombustible.
     * GET|HEAD /coberturaCombustibles/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $this->authorize('view', 'App\CoberturaCombustible');

        /** @var CoberturaCombustible $coberturaCombustible */
        $coberturaCombustible = $this->coberturaCombustibleRepository->findWithoutFail($id);

        if (empty($coberturaCombustible)) {
            return $this->sendError('Cobertura Combustible no encontrado');
        }

        return $this->sendResponse($coberturaCombustible->toArray(), 'Cobertura de Combustible recuperado con éxito');
    }

    /**
     * Update the specified CoberturaCombustible in storage.
     * PUT/PATCH /coberturaCombustibles/{id}
     *
     * @param  int $id
     * @param UpdateCoberturaCombustibleAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCoberturaCombustibleAPIRequest $request)
    {
        $this->authorize('update', 'App\CoberturaCombustible');

        $input = $request->all();

        /** @var CoberturaCombustible $coberturaCombustible */
        $coberturaCombustible = $this->coberturaCombustibleRepository->findWithoutFail($id);

        if (empty($coberturaCombustible)) {
            return $this->sendError('Cobertura de Combustible no encontrado');
        }

        $coberturaCombustible = $this->coberturaCombustibleRepository->update($input, $id);

        return $this->sendResponse($coberturaCombustible->toArray(), 'Cobertura de Combustible actualizado con éxito');
    }

    /**
     * Remove the specified CoberturaCombustible from storage.
     * DELETE /coberturaCombustibles/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $this->authorize('delete', 'App\CoberturaCombustible');

        /** @var CoberturaCombustible $coberturaCombustible */
        $coberturaCombustible = $this->coberturaCombustibleRepository->findWithoutFail($id);

        if (empty($coberturaCombustible)) {
            return $this->sendError('Cobertura de Combustible no encontrado');
        }

        $coberturaCombustible->delete();

        return $this->sendResponse($id, 'Cobertura de Combustible eliminado con éxito');
    }
}
