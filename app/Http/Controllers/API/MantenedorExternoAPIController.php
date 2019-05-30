<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateMantenedorExternoAPIRequest;
use App\Http\Requests\API\UpdateMantenedorExternoAPIRequest;
use App\Models\MantenedorExterno;
use App\Repositories\MantenedorExternoRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class MantenedorExternoController
 * @package App\Http\Controllers\API
 */

class MantenedorExternoAPIController extends AppBaseController
{
    /** @var  MantenedorExternoRepository */
    private $mantenedorExternoRepository;

    public function __construct(MantenedorExternoRepository $mantenedorExternoRepo)
    {
        $this->mantenedorExternoRepository = $mantenedorExternoRepo;
    }

    /**
     * Display a listing of the MantenedorExterno.
     * GET|HEAD /mantenedorExternos
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->mantenedorExternoRepository->pushCriteria(new RequestCriteria($request));
        $this->mantenedorExternoRepository->pushCriteria(new LimitOffsetCriteria($request));
        $mantenedorExternos = $this->mantenedorExternoRepository->all();

        return $this->sendResponse($mantenedorExternos->toArray(), 'Mantenedor Externos retrieved successfully');
    }

    /**
     * Store a newly created MantenedorExterno in storage.
     * POST /mantenedorExternos
     *
     * @param CreateMantenedorExternoAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateMantenedorExternoAPIRequest $request)
    {
        $input = $request->all();

        $mantenedorExterno = $this->mantenedorExternoRepository->create($input);

        return $this->sendResponse($mantenedorExterno->toArray(), 'Mantenedor Externo saved successfully');
    }

    /**
     * Display the specified MantenedorExterno.
     * GET|HEAD /mantenedorExternos/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var MantenedorExterno $mantenedorExterno */
        $mantenedorExterno = $this->mantenedorExternoRepository->findWithoutFail($id);

        if (empty($mantenedorExterno)) {
            return $this->sendError('Mantenedor Externo not found');
        }

        return $this->sendResponse($mantenedorExterno->toArray(), 'Mantenedor Externo retrieved successfully');
    }

    /**
     * Update the specified MantenedorExterno in storage.
     * PUT/PATCH /mantenedorExternos/{id}
     *
     * @param  int $id
     * @param UpdateMantenedorExternoAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMantenedorExternoAPIRequest $request)
    {
        $input = $request->all();

        /** @var MantenedorExterno $mantenedorExterno */
        $mantenedorExterno = $this->mantenedorExternoRepository->findWithoutFail($id);

        if (empty($mantenedorExterno)) {
            return $this->sendError('Mantenedor Externo not found');
        }

        $mantenedorExterno = $this->mantenedorExternoRepository->update($input, $id);

        return $this->sendResponse($mantenedorExterno->toArray(), 'MantenedorExterno updated successfully');
    }

    /**
     * Remove the specified MantenedorExterno from storage.
     * DELETE /mantenedorExternos/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var MantenedorExterno $mantenedorExterno */
        $mantenedorExterno = $this->mantenedorExternoRepository->findWithoutFail($id);

        if (empty($mantenedorExterno)) {
            return $this->sendError('Mantenedor Externo not found');
        }

        $mantenedorExterno->delete();

        return $this->sendResponse($id, 'Mantenedor Externo deleted successfully');
    }
}
