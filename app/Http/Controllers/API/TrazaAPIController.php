<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateTrazaAPIRequest;
use App\Http\Requests\API\UpdateTrazaAPIRequest;
use App\Models\Traza;
use App\Repositories\TrazaRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class TrazaController
 * @package App\Http\Controllers\API
 */

class TrazaAPIController extends AppBaseController
{
    /** @var  TrazaRepository */
    private $trazaRepository;

    public function __construct(TrazaRepository $trazaRepo)
    {
        $this->trazaRepository = $trazaRepo;
    }

    /**
     * Display a listing of the Traza.
     * GET|HEAD /trazas
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->authorize('view', 'App\Traza');
        $this->trazaRepository->pushCriteria(new RequestCriteria($request));
        $this->trazaRepository->pushCriteria(new LimitOffsetCriteria($request));
        $trazas = $this->trazaRepository->all();

        return $this->sendResponse($trazas->toArray(), 'Trazas retrieved successfully');
    }

    /**
     * Store a newly created Traza in storage.
     * POST /trazas
     *
     * @param CreateTrazaAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateTrazaAPIRequest $request)
    {
        $this->authorize('create', 'App\Traza');
    }

    /**
     * Display the specified Traza.
     * GET|HEAD /trazas/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $this->authorize('view', 'App\Traza');
        /** @var Traza $traza */
        $traza = $this->trazaRepository->findWithoutFail($id);

        if (empty($traza)) {
            return $this->sendError('Traza not found');
        }

        return $this->sendResponse($traza->toArray(), 'Traza retrieved successfully');
    }

    /**
     * Update the specified Traza in storage.
     * PUT/PATCH /trazas/{id}
     *
     * @param  int $id
     * @param UpdateTrazaAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTrazaAPIRequest $request)
    {
        $this->authorize('update', 'App\Traza');
    }

    /**
     * Remove the specified Traza from storage.
     * DELETE /trazas/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $this->authorize('delete', 'App\Traza');
    }
}
