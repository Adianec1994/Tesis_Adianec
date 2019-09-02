<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateBateriasAPIRequest;
use App\Http\Requests\API\UpdateBateriasAPIRequest;
use App\Models\Baterias;
use App\Repositories\BateriasRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class BateriasController
 * @package App\Http\Controllers\API
 */

class BateriasAPIController extends AppBaseController
{
    /** @var  BateriasRepository */
    private $bateriasRepository;

    public function __construct(BateriasRepository $bateriasRepo)
    {
        $this->bateriasRepository = $bateriasRepo;
    }

    /**
     * Display a listing of the Baterias.
     * GET|HEAD /baterias
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->authorize('view', 'App\Baterias');

        $this->bateriasRepository->pushCriteria(new RequestCriteria($request));
        $this->bateriasRepository->pushCriteria(new LimitOffsetCriteria($request));
        $baterias = $this->bateriasRepository->all();

        return $this->sendResponse($baterias->toArray(), 'Baterías recuperado con éxito');
    }

    /**
     * Store a newly created Baterias in storage.
     * POST /baterias
     *
     * @param CreateBateriasAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateBateriasAPIRequest $request)
    {
        $this->authorize('create', 'App\Baterias');
        $input = $request->all();

        $baterias = $this->bateriasRepository->create($input);

        return $this->sendResponse($baterias->toArray(), 'Baterías guardado con éxito');
    }

    /**
     * Display the specified Baterias.
     * GET|HEAD /baterias/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $this->authorize('view', 'App\Baterias');

        /** @var Baterias $baterias */
        $baterias = $this->bateriasRepository->findWithoutFail($id);

        if (empty($baterias)) {
            return $this->sendError('Baterias no encontrado');
        }

        return $this->sendResponse($baterias->toArray(), 'Baterías recuperado con éxito');
    }

    /**
     * Update the specified Baterias in storage.
     * PUT/PATCH /baterias/{id}
     *
     * @param  int $id
     * @param UpdateBateriasAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBateriasAPIRequest $request)
    {
        $this->authorize('update', 'App\Baterias');

        $input = $request->all();

        /** @var Baterias $baterias */
        $baterias = $this->bateriasRepository->findWithoutFail($id);

        if (empty($baterias)) {
            return $this->sendError('Baterías no encontrado');
        }

        $baterias = $this->bateriasRepository->update($input, $id);

        return $this->sendResponse($baterias->toArray(), 'Baterías actualizado con éxito');
    }

    /**
     * Remove the specified Baterias from storage.
     * DELETE /baterias/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $this->authorize('delete', 'App\Baterias');

        /** @var Baterias $baterias */
        $baterias = $this->bateriasRepository->findWithoutFail($id);

        if (empty($baterias)) {
            return $this->sendError('Baterías no encontrado');
        }

        $baterias->delete();

        return $this->sendResponse($id, 'Baterías eliminado con éxito');
    }
}
