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
        $this->bateriasRepository->pushCriteria(new RequestCriteria($request));
        $this->bateriasRepository->pushCriteria(new LimitOffsetCriteria($request));
        $baterias = $this->bateriasRepository->all();

        return $this->sendResponse($baterias->toArray(), 'Baterias retrieved successfully');
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
        $input = $request->all();

        $baterias = $this->bateriasRepository->create($input);

        return $this->sendResponse($baterias->toArray(), 'Baterias saved successfully');
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
        /** @var Baterias $baterias */
        $baterias = $this->bateriasRepository->findWithoutFail($id);

        if (empty($baterias)) {
            return $this->sendError('Baterias not found');
        }

        return $this->sendResponse($baterias->toArray(), 'Baterias retrieved successfully');
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
        $input = $request->all();

        /** @var Baterias $baterias */
        $baterias = $this->bateriasRepository->findWithoutFail($id);

        if (empty($baterias)) {
            return $this->sendError('Baterias not found');
        }

        $baterias = $this->bateriasRepository->update($input, $id);

        return $this->sendResponse($baterias->toArray(), 'Baterias updated successfully');
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
        /** @var Baterias $baterias */
        $baterias = $this->bateriasRepository->findWithoutFail($id);

        if (empty($baterias)) {
            return $this->sendError('Baterias not found');
        }

        $baterias->delete();

        return $this->sendResponse($id, 'Baterias deleted successfully');
    }
}
