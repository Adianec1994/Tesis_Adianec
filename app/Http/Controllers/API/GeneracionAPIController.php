<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateGeneracionAPIRequest;
use App\Http\Requests\API\UpdateGeneracionAPIRequest;
use App\Models\Generacion;
use App\Repositories\GeneracionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class GeneracionController
 * @package App\Http\Controllers\API
 */

class GeneracionAPIController extends AppBaseController
{
    /** @var  GeneracionRepository */
    private $generacionRepository;

    public function __construct(GeneracionRepository $generacionRepo)
    {
        $this->generacionRepository = $generacionRepo;
    }

    /**
     * Display a listing of the Generacion.
     * GET|HEAD /generacions
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->generacionRepository->pushCriteria(new RequestCriteria($request));
        $this->generacionRepository->pushCriteria(new LimitOffsetCriteria($request));
        $generacions = $this->generacionRepository->all();

        return $this->sendResponse($generacions->toArray(), 'Generacions retrieved successfully');
    }

    /**
     * Store a newly created Generacion in storage.
     * POST /generacions
     *
     * @param CreateGeneracionAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateGeneracionAPIRequest $request)
    {
        $input = $request->all();

        $generacion = $this->generacionRepository->create($input);

        return $this->sendResponse($generacion->toArray(), 'Generacion saved successfully');
    }

    /**
     * Display the specified Generacion.
     * GET|HEAD /generacions/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Generacion $generacion */
        $generacion = $this->generacionRepository->findWithoutFail($id);

        if (empty($generacion)) {
            return $this->sendError('Generacion not found');
        }

        return $this->sendResponse($generacion->toArray(), 'Generacion retrieved successfully');
    }

    /**
     * Update the specified Generacion in storage.
     * PUT/PATCH /generacions/{id}
     *
     * @param  int $id
     * @param UpdateGeneracionAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateGeneracionAPIRequest $request)
    {
        $input = $request->all();

        /** @var Generacion $generacion */
        $generacion = $this->generacionRepository->findWithoutFail($id);

        if (empty($generacion)) {
            return $this->sendError('Generacion not found');
        }

        $generacion = $this->generacionRepository->update($input, $id);

        return $this->sendResponse($generacion->toArray(), 'Generacion updated successfully');
    }

    /**
     * Remove the specified Generacion from storage.
     * DELETE /generacions/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Generacion $generacion */
        $generacion = $this->generacionRepository->findWithoutFail($id);

        if (empty($generacion)) {
            return $this->sendError('Generacion not found');
        }

        $generacion->delete();

        return $this->sendResponse($id, 'Generacion deleted successfully');
    }
}
