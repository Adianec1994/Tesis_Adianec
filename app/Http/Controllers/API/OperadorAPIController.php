<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateOperadorAPIRequest;
use App\Http\Requests\API\UpdateOperadorAPIRequest;
use App\Models\Operador;
use App\Repositories\OperadorRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class OperadorController
 * @package App\Http\Controllers\API
 */

class OperadorAPIController extends AppBaseController
{
    /** @var  OperadorRepository */
    private $operadorRepository;

    public function __construct(OperadorRepository $operadorRepo)
    {
        $this->operadorRepository = $operadorRepo;
    }

    /**
     * Display a listing of the Operador.
     * GET|HEAD /operadors
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->operadorRepository->pushCriteria(new RequestCriteria($request));
        $this->operadorRepository->pushCriteria(new LimitOffsetCriteria($request));
        $operadors = $this->operadorRepository->all();

        return $this->sendResponse($operadors->toArray(), 'Operadors retrieved successfully');
    }

    /**
     * Store a newly created Operador in storage.
     * POST /operadors
     *
     * @param CreateOperadorAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateOperadorAPIRequest $request)
    {
        $input = $request->all();

        $operador = $this->operadorRepository->create($input);

        return $this->sendResponse($operador->toArray(), 'Operador saved successfully');
    }

    /**
     * Display the specified Operador.
     * GET|HEAD /operadors/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Operador $operador */
        $operador = $this->operadorRepository->findWithoutFail($id);

        if (empty($operador)) {
            return $this->sendError('Operador not found');
        }

        return $this->sendResponse($operador->toArray(), 'Operador retrieved successfully');
    }

    /**
     * Update the specified Operador in storage.
     * PUT/PATCH /operadors/{id}
     *
     * @param  int $id
     * @param UpdateOperadorAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOperadorAPIRequest $request)
    {
        $input = $request->all();

        /** @var Operador $operador */
        $operador = $this->operadorRepository->findWithoutFail($id);

        if (empty($operador)) {
            return $this->sendError('Operador not found');
        }

        $operador = $this->operadorRepository->update($input, $id);

        return $this->sendResponse($operador->toArray(), 'Operador updated successfully');
    }

    /**
     * Remove the specified Operador from storage.
     * DELETE /operadors/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Operador $operador */
        $operador = $this->operadorRepository->findWithoutFail($id);

        if (empty($operador)) {
            return $this->sendError('Operador not found');
        }

        $operador->delete();

        return $this->sendResponse($id, 'Operador deleted successfully');
    }
}
