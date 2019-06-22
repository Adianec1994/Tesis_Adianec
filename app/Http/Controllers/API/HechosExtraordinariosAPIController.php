<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateHechosExtraordinariosAPIRequest;
use App\Http\Requests\API\UpdateHechosExtraordinariosAPIRequest;
use App\Models\HechosExtraordinarios;
use App\Repositories\HechosExtraordinariosRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class HechosExtraordinariosController
 * @package App\Http\Controllers\API
 */

class HechosExtraordinariosAPIController extends AppBaseController
{
    /** @var  HechosExtraordinariosRepository */
    private $hechosExtraordinariosRepository;

    public function __construct(HechosExtraordinariosRepository $hechosExtraordinariosRepo)
    {
        $this->hechosExtraordinariosRepository = $hechosExtraordinariosRepo;
    }

    /**
     * Display a listing of the HechosExtraordinarios.
     * GET|HEAD /hechosExtraordinarios
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->hechosExtraordinariosRepository->pushCriteria(new RequestCriteria($request));
        $this->hechosExtraordinariosRepository->pushCriteria(new LimitOffsetCriteria($request));
        $hechosExtraordinarios = $this->hechosExtraordinariosRepository->all();

        return $this->sendResponse($hechosExtraordinarios->toArray(), 'Hechos Extraordinarios recuperados con éxito');
    }

    /**
     * Store a newly created HechosExtraordinarios in storage.
     * POST /hechosExtraordinarios
     *
     * @param CreateHechosExtraordinariosAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateHechosExtraordinariosAPIRequest $request)
    {
        $input = $request->all();

        $hechosExtraordinarios = $this->hechosExtraordinariosRepository->create($input);

        return $this->sendResponse($hechosExtraordinarios->toArray(), 'Hecho Extraordinario guardado con éxito');
    }

    /**
     * Display the specified HechosExtraordinarios.
     * GET|HEAD /hechosExtraordinarios/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var HechosExtraordinarios $hechosExtraordinarios */
        $hechosExtraordinarios = $this->hechosExtraordinariosRepository->findWithoutFail($id);

        if (empty($hechosExtraordinarios)) {
            return $this->sendError('Hechos Extraordinarios no encontrado');
        }

        return $this->sendResponse($hechosExtraordinarios->toArray(), 'Hechos Extraordinarios recuperado con éxito');
    }

    /**
     * Update the specified HechosExtraordinarios in storage.
     * PUT/PATCH /hechosExtraordinarios/{id}
     *
     * @param  int $id
     * @param UpdateHechosExtraordinariosAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateHechosExtraordinariosAPIRequest $request)
    {
        $input = $request->all();

        /** @var HechosExtraordinarios $hechosExtraordinarios */
        $hechosExtraordinarios = $this->hechosExtraordinariosRepository->findWithoutFail($id);

        if (empty($hechosExtraordinarios)) {
            return $this->sendError('Hechos Extraordinarios no encontrado');
        }

        $hechosExtraordinarios = $this->hechosExtraordinariosRepository->update($input, $id);

        return $this->sendResponse($hechosExtraordinarios->toArray(), 'Hecho Extraordinario actualizado con éxito');
    }

    /**
     * Remove the specified HechosExtraordinarios from storage.
     * DELETE /hechosExtraordinarios/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var HechosExtraordinarios $hechosExtraordinarios */
        $hechosExtraordinarios = $this->hechosExtraordinariosRepository->findWithoutFail($id);

        if (empty($hechosExtraordinarios)) {
            return $this->sendError('Hechos Extraordinarios no encontrado');
        }

        $hechosExtraordinarios->delete();

        return $this->sendResponse($id, 'Hecho Extraordinario eliminado con éxito');
    }
}
