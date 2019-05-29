<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePailasAPIRequest;
use App\Http\Requests\API\UpdatePailasAPIRequest;
use App\Models\Pailas;
use App\Repositories\PailasRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class PailasController
 * @package App\Http\Controllers\API
 */

class PailasAPIController extends AppBaseController
{
    /** @var  PailasRepository */
    private $pailasRepository;

    public function __construct(PailasRepository $pailasRepo)
    {
        $this->pailasRepository = $pailasRepo;
    }

    /**
     * Display a listing of the Pailas.
     * GET|HEAD /pailas
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->pailasRepository->pushCriteria(new RequestCriteria($request));
        $this->pailasRepository->pushCriteria(new LimitOffsetCriteria($request));
        $pailas = $this->pailasRepository->all();

        return $this->sendResponse($pailas->toArray(), 'Pailas retrieved successfully');
    }

    /**
     * Store a newly created Pailas in storage.
     * POST /pailas
     *
     * @param CreatePailasAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatePailasAPIRequest $request)
    {
        $input = $request->all();

        $pailas = $this->pailasRepository->create($input);

        return $this->sendResponse($pailas->toArray(), 'Pailas saved successfully');
    }

    /**
     * Display the specified Pailas.
     * GET|HEAD /pailas/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Pailas $pailas */
        $pailas = $this->pailasRepository->findWithoutFail($id);

        if (empty($pailas)) {
            return $this->sendError('Pailas not found');
        }

        return $this->sendResponse($pailas->toArray(), 'Pailas retrieved successfully');
    }

    /**
     * Update the specified Pailas in storage.
     * PUT/PATCH /pailas/{id}
     *
     * @param  int $id
     * @param UpdatePailasAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePailasAPIRequest $request)
    {
        $input = $request->all();

        /** @var Pailas $pailas */
        $pailas = $this->pailasRepository->findWithoutFail($id);

        if (empty($pailas)) {
            return $this->sendError('Pailas not found');
        }

        $pailas = $this->pailasRepository->update($input, $id);

        return $this->sendResponse($pailas->toArray(), 'Pailas updated successfully');
    }

    /**
     * Remove the specified Pailas from storage.
     * DELETE /pailas/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Pailas $pailas */
        $pailas = $this->pailasRepository->findWithoutFail($id);

        if (empty($pailas)) {
            return $this->sendError('Pailas not found');
        }

        $pailas->delete();

        return $this->sendResponse($id, 'Pailas deleted successfully');
    }
}
