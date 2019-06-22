<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateProveedorAPIRequest;
use App\Http\Requests\API\UpdateProveedorAPIRequest;
use App\Models\Proveedor;
use App\Repositories\ProveedorRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class ProveedorController
 * @package App\Http\Controllers\API
 */

class ProveedorAPIController extends AppBaseController
{
    /** @var  ProveedorRepository */
    private $proveedorRepository;

    public function __construct(ProveedorRepository $proveedorRepo)
    {
        $this->proveedorRepository = $proveedorRepo;
    }

    /**
     * Display a listing of the Proveedor.
     * GET|HEAD /proveedors
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->proveedorRepository->pushCriteria(new RequestCriteria($request));
        $this->proveedorRepository->pushCriteria(new LimitOffsetCriteria($request));
        $proveedors = $this->proveedorRepository->all();

        return $this->sendResponse($proveedors->toArray(), 'Proveedores recuperados con éxito');
    }

    /**
     * Store a newly created Proveedor in storage.
     * POST /proveedors
     *
     * @param CreateProveedorAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateProveedorAPIRequest $request)
    {
        $input = $request->all();

        $input['nombre'] = $input['marca'] . '-' . $input['serie'];

        $proveedor = $this->proveedorRepository->create($input);

        return $this->sendResponse($proveedor->toArray(), 'Proveedor guardado con éxito');
    }

    /**
     * Display the specified Proveedor.
     * GET|HEAD /proveedors/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Proveedor $proveedor */
        $proveedor = $this->proveedorRepository->findWithoutFail($id);

        if (empty($proveedor)) {
            return $this->sendError('Proveedor no encontrado');
        }

        return $this->sendResponse($proveedor->toArray(), 'Proveedor recuperado con éxito');
    }

    /**
     * Update the specified Proveedor in storage.
     * PUT/PATCH /proveedors/{id}
     *
     * @param  int $id
     * @param UpdateProveedorAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProveedorAPIRequest $request)
    {
        $input = $request->all();

        $input['nombre'] = $input['marca'] . '-' . $input['serie'];

        /** @var Proveedor $proveedor */
        $proveedor = $this->proveedorRepository->findWithoutFail($id);

        if (empty($proveedor)) {
            return $this->sendError('Proveedor no encontrado');
        }

        $proveedor = $this->proveedorRepository->update($input, $id);

        return $this->sendResponse($proveedor->toArray(), 'Proveedor actualizado con éxito');
    }

    /**
     * Remove the specified Proveedor from storage.
     * DELETE /proveedors/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Proveedor $proveedor */
        $proveedor = $this->proveedorRepository->findWithoutFail($id);

        if (empty($proveedor)) {
            return $this->sendError('Proveedor no encontrado');
        }

        $proveedor->delete();

        return $this->sendResponse($id, 'Proveedor eliminado con éxito');
    }
}
