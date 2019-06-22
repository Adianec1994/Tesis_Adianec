<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateGruposAPIRequest;
use App\Http\Requests\API\UpdateGruposAPIRequest;
use App\Models\Grupos;
use App\Repositories\GruposRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class GruposController
 * @package App\Http\Controllers\API
 */

class GruposAPIController extends AppBaseController
{
    /** @var  GruposRepository */
    private $gruposRepository;

    public function __construct(GruposRepository $gruposRepo)
    {
        $this->gruposRepository = $gruposRepo;
    }

    /**
     * Display a listing of the Grupos.
     * GET|HEAD /grupos
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->gruposRepository->pushCriteria(new RequestCriteria($request));
        $this->gruposRepository->pushCriteria(new LimitOffsetCriteria($request));
        $grupos = $this->gruposRepository->all();

        return $this->sendResponse($grupos->toArray(), 'Grupos recuperados con éxito');
    }

    /**
     * Store a newly created Grupos in storage.
     * POST /grupos
     *
     * @param CreateGruposAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateGruposAPIRequest $request)
    {
        $input = $request->all();

        $grupos = $this->gruposRepository->create($input);

        return $this->sendResponse($grupos->toArray(), 'Grupo guardado con éxito');
    }

    /**
     * Display the specified Grupos.
     * GET|HEAD /grupos/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Grupos $grupos */
        $grupos = $this->gruposRepository->findWithoutFail($id);

        if (empty($grupos)) {
            return $this->sendError('Grupos no encontrado');
        }

        return $this->sendResponse($grupos->toArray(), 'Grupos recuperado con éxito');
    }

    /**
     * Update the specified Grupos in storage.
     * PUT/PATCH /grupos/{id}
     *
     * @param  int $id
     * @param UpdateGruposAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateGruposAPIRequest $request)
    {
        $input = $request->all();

        /** @var Grupos $grupos */
        $grupos = $this->gruposRepository->findWithoutFail($id);

        if (empty($grupos)) {
            return $this->sendError('Grupos no encontrado');
        }

        $grupos = $this->gruposRepository->update($input, $id);

        return $this->sendResponse($grupos->toArray(), 'Grupos actualizado con éxito');
    }

    /**
     * Remove the specified Grupos from storage.
     * DELETE /grupos/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Grupos $grupos */
        $grupos = $this->gruposRepository->findWithoutFail($id);

        if (empty($grupos)) {
            return $this->sendError('Grupos no encontrado');
        }

        $grupos->delete();

        return $this->sendResponse($id, 'Grupo eliminado con éxito');
    }
}
