<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateProvinciaAPIRequest;
use App\Http\Requests\API\UpdateProvinciaAPIRequest;
use App\Models\Provincia;
use App\Repositories\ProvinciaRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class ProvinciaController
 * @package App\Http\Controllers\API
 */

class ProvinciaAPIController extends AppBaseController
{
    /** @var  ProvinciaRepository */
    private $provinciaRepository;

    public function __construct(ProvinciaRepository $provinciaRepo)
    {
        $this->provinciaRepository = $provinciaRepo;
    }

    /**
     * Display a listing of the Provincia.
     * GET|HEAD /provincias
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->authorize('view', 'App\Provincia');
        $this->provinciaRepository->pushCriteria(new RequestCriteria($request));
        $this->provinciaRepository->pushCriteria(new LimitOffsetCriteria($request));
        $provincias = $this->provinciaRepository->all();

        return $this->sendResponse($provincias->toArray(), 'Provincias retrieved successfully');
    }

    /**
     * Store a newly created Provincia in storage.
     * POST /provincias
     *
     * @param CreateProvinciaAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateProvinciaAPIRequest $request)
    {
        $this->authorize('create', 'App\Provincia');
        $input = $request->all();

        $provincia = $this->provinciaRepository->create($input);

        return $this->sendResponse($provincia->toArray(), 'Provincia saved successfully');
    }

    /**
     * Display the specified Provincia.
     * GET|HEAD /provincias/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $this->authorize('view', 'App\Provincia');
        /** @var Provincia $provincia */
        $provincia = $this->provinciaRepository->findWithoutFail($id);

        if (empty($provincia)) {
            return $this->sendError('Provincia not found');
        }

        return $this->sendResponse($provincia->toArray(), 'Provincia retrieved successfully');
    }

    /**
     * Update the specified Provincia in storage.
     * PUT/PATCH /provincias/{id}
     *
     * @param  int $id
     * @param UpdateProvinciaAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProvinciaAPIRequest $request)
    {
        $this->authorize('update', 'App\Provincia');
        $input = $request->all();

        /** @var Provincia $provincia */
        $provincia = $this->provinciaRepository->findWithoutFail($id);

        if (empty($provincia)) {
            return $this->sendError('Provincia not found');
        }

        $provincia = $this->provinciaRepository->update($input, $id);

        return $this->sendResponse($provincia->toArray(), 'Provincia updated successfully');
    }

    /**
     * Remove the specified Provincia from storage.
     * DELETE /provincias/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $this->authorize('delete', 'App\Provincia');
        /** @var Provincia $provincia */
        $provincia = $this->provinciaRepository->findWithoutFail($id);

        if (empty($provincia)) {
            return $this->sendError('Provincia not found');
        }

        $provincia->delete();

        return $this->sendResponse($id, 'Provincia deleted successfully');
    }
}
