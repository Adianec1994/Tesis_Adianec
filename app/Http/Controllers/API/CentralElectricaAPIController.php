<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCentralElectricaAPIRequest;
use App\Http\Requests\API\UpdateCentralElectricaAPIRequest;
use App\Models\CentralElectrica;
use App\Repositories\CentralElectricaRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class CentralElectricaController
 * @package App\Http\Controllers\API
 */

class CentralElectricaAPIController extends AppBaseController
{
    /** @var  CentralElectricaRepository */
    private $centralElectricaRepository;

    public function __construct(CentralElectricaRepository $centralElectricaRepo)
    {
        $this->centralElectricaRepository = $centralElectricaRepo;
    }

    /**
     * Display a listing of the CentralElectrica.
     * GET|HEAD /centralElectricas
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->authorize('view', 'App\CentralElectrica');

        $this->centralElectricaRepository->pushCriteria(new RequestCriteria($request));
        $this->centralElectricaRepository->pushCriteria(new LimitOffsetCriteria($request));
        // $centralElectricas = $this->centralElectricaRepository->all();

        $centralElectricas = CentralElectrica::with('Baterias.Grupos')->get();
        return $this->sendResponse($centralElectricas, 'Centrales Eléctricas recuperadas con éxito');
    }

    /**
     * Store a newly created CentralElectrica in storage.
     * POST /centralElectricas
     *
     * @param CreateCentralElectricaAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateCentralElectricaAPIRequest $request)
    {
        $this->authorize('create', 'App\CentralElectrica');

        $input = $request->all();

        $centralElectrica = $this->centralElectricaRepository->create($input);

        return $this->sendResponse($centralElectrica->toArray(), 'Central Eléctrica guardado con éxito');
    }

    /**
     * Display the specified CentralElectrica.
     * GET|HEAD /centralElectricas/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $this->authorize('view', 'App\CentralElectrica');

        /** @var CentralElectrica $centralElectrica */
        $centralElectrica = $this->centralElectricaRepository->findWithoutFail($id);

        if (empty($centralElectrica)) {
            return $this->sendError('Central Eléctrica no encontrado');
        }

        return $this->sendResponse($centralElectrica->toArray(), 'Central Eléctrica recuperado con éxito');
    }

    /**
     * Update the specified CentralElectrica in storage.
     * PUT/PATCH /centralElectricas/{id}
     *
     * @param  int $id
     * @param UpdateCentralElectricaAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCentralElectricaAPIRequest $request)
    {
        $this->authorize('update', 'App\CentralElectrica');

        $input = $request->all();

        /** @var CentralElectrica $centralElectrica */
        $centralElectrica = $this->centralElectricaRepository->findWithoutFail($id);

        if (empty($centralElectrica)) {
            return $this->sendError('Central Eléctrica no encontrado');
        }

        $centralElectrica = $this->centralElectricaRepository->update($input, $id);

        return $this->sendResponse($centralElectrica->toArray(), 'Central Eléctrica actualizado con éxito');
    }

    /**
     * Remove the specified CentralElectrica from storage.
     * DELETE /centralElectricas/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $this->authorize('delete', 'App\CentralElectrica');

        /** @var CentralElectrica $centralElectrica */
        $centralElectrica = $this->centralElectricaRepository->findWithoutFail($id);

        if (empty($centralElectrica)) {
            return $this->sendError('Central Eléctrica no encontrado');
        }

        $centralElectrica->delete();

        return $this->sendResponse($id, 'Central Eléctrica eliminado con éxito');
    }
}
