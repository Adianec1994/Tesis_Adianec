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
        $this->authorize('view', 'App\MantenedorExterno');

        $this->mantenedorExternoRepository->pushCriteria(new RequestCriteria($request));
        $this->mantenedorExternoRepository->pushCriteria(new LimitOffsetCriteria($request));
        $mantenedorExternos = $this->mantenedorExternoRepository->all();

        return $this->sendResponse($mantenedorExternos->toArray(), 'Mantenedores Externos recuperados con éxito');
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
        $this->authorize('create', 'App\MantenedorExterno');

        $input = $request->all();

        $mantenedorExterno = $this->mantenedorExternoRepository->create($input);

        return $this->sendResponse($mantenedorExterno->toArray(), 'Mantenedor Externo guardado con éxito');
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
        $this->authorize('view', 'App\MantenedorExterno');

        /** @var MantenedorExterno $mantenedorExterno */
        $mantenedorExterno = $this->mantenedorExternoRepository->findWithoutFail($id);

        if (empty($mantenedorExterno)) {
            return $this->sendError('Mantenedor Externo no encontrado');
        }

        return $this->sendResponse($mantenedorExterno->toArray(), 'Mantenedor Externo recuperado con éxito');
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
        $this->authorize('update', 'App\MantenedorExterno');

        $input = $request->all();

        /** @var MantenedorExterno $mantenedorExterno */
        $mantenedorExterno = $this->mantenedorExternoRepository->findWithoutFail($id);

        if (empty($mantenedorExterno)) {
            return $this->sendError('Mantenedor Externo no encontrado');
        }

        $mantenedorExterno = $this->mantenedorExternoRepository->update($input, $id);

        return $this->sendResponse($mantenedorExterno->toArray(), 'Mantenedor Externo actualizado con éxito');
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
        $this->authorize('delete', 'App\MantenedorExterno');

        /** @var MantenedorExterno $mantenedorExterno */
        $mantenedorExterno = $this->mantenedorExternoRepository->findWithoutFail($id);

        if (empty($mantenedorExterno)) {
            return $this->sendError('Mantenedor Externo no encontrado');
        }

        $mantenedorExterno->delete();

        return $this->sendResponse($id, 'Mantenedor Externo eliminado con éxito');
    }
}
