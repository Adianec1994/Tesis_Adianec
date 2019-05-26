<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateDatosGeneralesAPIRequest;
use App\Http\Requests\API\UpdateDatosGeneralesAPIRequest;
use App\Models\DatosGenerales;
use App\Repositories\DatosGeneralesRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class DatosGeneralesController
 * @package App\Http\Controllers\API
 */

class DatosGeneralesAPIController extends AppBaseController
{
    /** @var  DatosGeneralesRepository */
    private $datosGeneralesRepository;

    public function __construct(DatosGeneralesRepository $datosGeneralesRepo)
    {
        $this->datosGeneralesRepository = $datosGeneralesRepo;
    }

    /**
     * Display a listing of the DatosGenerales.
     * GET|HEAD /datosGenerales
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->datosGeneralesRepository->pushCriteria(new RequestCriteria($request));
        $this->datosGeneralesRepository->pushCriteria(new LimitOffsetCriteria($request));
        $datosGenerales = $this->datosGeneralesRepository->all();

        return $this->sendResponse($datosGenerales->toArray(), 'Datos Generales retrieved successfully');
    }

    /**
     * Store a newly created DatosGenerales in storage.
     * POST /datosGenerales
     *
     * @param CreateDatosGeneralesAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateDatosGeneralesAPIRequest $request)
    {
        $input = $request->all();

        $datosGenerales = $this->datosGeneralesRepository->create($input);

        return $this->sendResponse($datosGenerales->toArray(), 'Datos Generales saved successfully');
    }

    /**
     * Display the specified DatosGenerales.
     * GET|HEAD /datosGenerales/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var DatosGenerales $datosGenerales */
        $datosGenerales = $this->datosGeneralesRepository->findWithoutFail($id);

        if (empty($datosGenerales)) {
            return $this->sendError('Datos Generales not found');
        }

        return $this->sendResponse($datosGenerales->toArray(), 'Datos Generales retrieved successfully');
    }

    /**
     * Update the specified DatosGenerales in storage.
     * PUT/PATCH /datosGenerales/{id}
     *
     * @param  int $id
     * @param UpdateDatosGeneralesAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDatosGeneralesAPIRequest $request)
    {
        $input = $request->all();

        /** @var DatosGenerales $datosGenerales */
        $datosGenerales = $this->datosGeneralesRepository->findWithoutFail($id);

        if (empty($datosGenerales)) {
            return $this->sendError('Datos Generales not found');
        }

        $datosGenerales = $this->datosGeneralesRepository->update($input, $id);

        return $this->sendResponse($datosGenerales->toArray(), 'DatosGenerales updated successfully');
    }

    /**
     * Remove the specified DatosGenerales from storage.
     * DELETE /datosGenerales/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var DatosGenerales $datosGenerales */
        $datosGenerales = $this->datosGeneralesRepository->findWithoutFail($id);

        if (empty($datosGenerales)) {
            return $this->sendError('Datos Generales not found');
        }

        $datosGenerales->delete();

        return $this->sendResponse($id, 'Datos Generales deleted successfully');
    }
}
