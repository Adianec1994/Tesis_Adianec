<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateEventoDiarioAPIRequest;
use App\Http\Requests\API\UpdateEventoDiarioAPIRequest;
use App\Models\EventoDiario;
use App\Repositories\EventoDiarioRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class EventoDiarioController
 * @package App\Http\Controllers\API
 */

class EventoDiarioAPIController extends AppBaseController
{
    /** @var  EventoDiarioRepository */
    private $eventoDiarioRepository;

    public function __construct(EventoDiarioRepository $eventoDiarioRepo)
    {
        $this->eventoDiarioRepository = $eventoDiarioRepo;
    }

    /**
     * Display a listing of the EventoDiario.
     * GET|HEAD /eventoDiarios
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->eventoDiarioRepository->pushCriteria(new RequestCriteria($request));
        $this->eventoDiarioRepository->pushCriteria(new LimitOffsetCriteria($request));
        $eventoDiarios = $this->eventoDiarioRepository->all();

        return $this->sendResponse($eventoDiarios->toArray(), 'Eventos Diarios recuperado con éxito');
    }

    /**
     * Store a newly created EventoDiario in storage.
     * POST /eventoDiarios
     *
     * @param CreateEventoDiarioAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateEventoDiarioAPIRequest $request)
    {
        $input = $request->all();

        $eventoDiario = $this->eventoDiarioRepository->create($input);

        return $this->sendResponse($eventoDiario->toArray(), 'Evento Diario guardado con éxito');
    }

    /**
     * Display the specified EventoDiario.
     * GET|HEAD /eventoDiarios/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var EventoDiario $eventoDiario */
        $eventoDiario = $this->eventoDiarioRepository->findWithoutFail($id);

        if (empty($eventoDiario)) {
            return $this->sendError('Evento Diario no encontrado');
        }

        return $this->sendResponse($eventoDiario->toArray(), 'Evento Diario recuperado con éxito');
    }

    /**
     * Update the specified EventoDiario in storage.
     * PUT/PATCH /eventoDiarios/{id}
     *
     * @param  int $id
     * @param UpdateEventoDiarioAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEventoDiarioAPIRequest $request)
    {
        $input = $request->all();

        /** @var EventoDiario $eventoDiario */
        $eventoDiario = $this->eventoDiarioRepository->findWithoutFail($id);

        if (empty($eventoDiario)) {
            return $this->sendError('Evento Diario no encontrado');
        }

        $eventoDiario = $this->eventoDiarioRepository->update($input, $id);

        return $this->sendResponse($eventoDiario->toArray(), 'Evento Diario actualizado con éxito');
    }

    /**
     * Remove the specified EventoDiario from storage.
     * DELETE /eventoDiarios/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var EventoDiario $eventoDiario */
        $eventoDiario = $this->eventoDiarioRepository->findWithoutFail($id);

        if (empty($eventoDiario)) {
            return $this->sendError('Evento Diario no encontrado');
        }

        $eventoDiario->delete();

        return $this->sendResponse($id, 'Evento Diario eliminado con éxito');
    }
}
