<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePlanesAPIRequest;
use App\Http\Requests\API\UpdatePlanesAPIRequest;
use App\Models\Planes;
use App\Repositories\PlanesRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class PlanesController
 * @package App\Http\Controllers\API
 */

class PlanesAPIController extends AppBaseController
{
    /** @var  PlanesRepository */
    private $planesRepository;

    public function __construct(PlanesRepository $planesRepo)
    {
        $this->planesRepository = $planesRepo;
    }

    /**
     * Display a listing of the Planes.
     * GET|HEAD /planes
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->planesRepository->pushCriteria(new RequestCriteria($request));
        $this->planesRepository->pushCriteria(new LimitOffsetCriteria($request));
        $planes = $this->planesRepository->all();

        return $this->sendResponse($planes->toArray(), 'Planes recuperados con éxito');
    }

    /**
     * Store a newly created Planes in storage.
     * POST /planes
     *
     * @param CreatePlanesAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatePlanesAPIRequest $request)
    {
        $input = $request->all();

        $planes = $this->planesRepository->create($input);

        return $this->sendResponse($planes->toArray(), 'Planes guardados con éxito');
    }

    /**
     * Display the specified Planes.
     * GET|HEAD /planes/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Planes $planes */
        $planes = $this->planesRepository->findWithoutFail($id);

        if (empty($planes)) {
            return $this->sendError('Planes no encontrados');
        }

        return $this->sendResponse($planes->toArray(), 'Planes recuperados con éxito');
    }

    /**
     * Update the specified Planes in storage.
     * PUT/PATCH /planes/{id}
     *
     * @param  int $id
     * @param UpdatePlanesAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePlanesAPIRequest $request)
    {
        $input = $request->all();

        /** @var Planes $planes */
        $planes = $this->planesRepository->findWithoutFail($id);

        if (empty($planes)) {
            return $this->sendError('Planes no encontrados');
        }

        $planes = $this->planesRepository->update($input, $id);

        return $this->sendResponse($planes->toArray(), 'Planes actualizados con éxito');
    }

    /**
     * Remove the specified Planes from storage.
     * DELETE /planes/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Planes $planes */
        $planes = $this->planesRepository->findWithoutFail($id);

        if (empty($planes)) {
            return $this->sendError('Planes no encontrados');
        }

        $planes->delete();

        return $this->sendResponse($id, 'Planes eliminados con éxito');
    }
}
