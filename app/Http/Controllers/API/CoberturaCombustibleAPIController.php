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
        $this->coberturaCombustibleRepository->pushCriteria(new RequestCriteria($request));
        $this->coberturaCombustibleRepository->pushCriteria(new LimitOffsetCriteria($request));
        $coberturaCombustibles = $this->coberturaCombustibleRepository->all();

        return $this->sendResponse($coberturaCombustibles->toArray(), 'Cobertura Combustibles retrieved successfully');
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
        $input = $request->all();

        $coberturaCombustible = $this->coberturaCombustibleRepository->create($input);

        return $this->sendResponse($coberturaCombustible->toArray(), 'Cobertura Combustible saved successfully');
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
        /** @var CoberturaCombustible $coberturaCombustible */
        $coberturaCombustible = $this->coberturaCombustibleRepository->findWithoutFail($id);

        if (empty($coberturaCombustible)) {
            return $this->sendError('Cobertura Combustible not found');
        }

        return $this->sendResponse($coberturaCombustible->toArray(), 'Cobertura Combustible retrieved successfully');
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
        $input = $request->all();

        /** @var CoberturaCombustible $coberturaCombustible */
        $coberturaCombustible = $this->coberturaCombustibleRepository->findWithoutFail($id);

        if (empty($coberturaCombustible)) {
            return $this->sendError('Cobertura Combustible not found');
        }

        $coberturaCombustible = $this->coberturaCombustibleRepository->update($input, $id);

        return $this->sendResponse($coberturaCombustible->toArray(), 'CoberturaCombustible updated successfully');
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
        /** @var CoberturaCombustible $coberturaCombustible */
        $coberturaCombustible = $this->coberturaCombustibleRepository->findWithoutFail($id);

        if (empty($coberturaCombustible)) {
            return $this->sendError('Cobertura Combustible not found');
        }

        $coberturaCombustible->delete();

        return $this->sendResponse($id, 'Cobertura Combustible deleted successfully');
    }
}
