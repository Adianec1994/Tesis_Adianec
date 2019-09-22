<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateBrigadaAPIRequest;
use App\Http\Requests\API\UpdateBrigadaAPIRequest;
use App\Models\Brigada;
use App\Repositories\BrigadaRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class BrigadaController
 * @package App\Http\Controllers\API
 */

class BrigadasAPIController extends AppBaseController
{
    /** @var  BrigadaRepository */
    private $brigadaRepository;

    public function __construct(BrigadaRepository $brigadaRepo)
    {
        $this->brigadaRepository = $brigadaRepo;
    }

    /**
     * Display a listing of the Brigada.
     * GET|HEAD /brigadas
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->authorize('view', 'App\Brigada');

        $this->brigadaRepository->pushCriteria(new RequestCriteria($request));
        $this->brigadaRepository->pushCriteria(new LimitOffsetCriteria($request));
        $brigada = $this->brigadaRepository->all();

        return $this->sendResponse($brigada->toArray(), 'Brigadas recuperadas con éxito');
    }

    /**
     * Store a newly created Brigada in storage.
     * POST /brigadas
     *
     * @param CreateBrigadaAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateBrigadaAPIRequest $request)
    {
        $this->authorize('create', 'App\Brigada');

        $input = $request->all();

        $brigada = $this->brigadaRepository->create($input);

        return $this->sendResponse($brigada->toArray(), 'Brigada guardada con éxito');
    }

    /**
     * Display the specified Brigada.
     * GET|HEAD /brigadas/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $this->authorize('view', 'App\Brigada');

        /** @var Brigada $brigada */
        $brigada = $this->brigadaRepository->findWithoutFail($id);

        if (empty($brigada)) {
            return $this->sendError('Brigada no encontrada');
        }

        return $this->sendResponse($brigada->toArray(), 'Brigada recuperada con éxito');
    }

    /**
     * Update the specified Brigada in storage.
     * PUT/PATCH /brigadas/{id}
     *
     * @param  int $id
     * @param UpdateBrigadaAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBrigadaAPIRequest $request)
    {
        $this->authorize('update', 'App\Brigada');

        $input = $request->all();

        /** @var Brigada $brigada */
        $brigada = $this->brigadaRepository->findWithoutFail($id);

        if (empty($brigada)) {
            return $this->sendError('Brigada no encontrada');
        }

        $brigada = $this->brigadaRepository->update($input, $id);

        return $this->sendResponse($brigada->toArray(), 'Brigada actualizada con éxito');
    }

    /**
     * Remove the specified Brigada from storage.
     * DELETE /brigadas/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $this->authorize('delete', 'App\Brigada');

        /** @var Brigada $brigada */
        $brigada = $this->brigadaRepository->findWithoutFail($id);

        if (empty($brigada)) {
            return $this->sendError('Brigada no encontrado');
        }

        $brigada->delete();

        return $this->sendResponse($id, 'Brigada eliminada con éxito');
    }
}
