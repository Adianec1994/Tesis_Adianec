<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;
use Artisan;
use Storage;

/**
 * Class SnapshotsAPIController
 * @package App\Http\Controllers\API
 */

class SnapshotsAPIController extends AppBaseController
{
    private $storage;

    public function __construct()
    {
        $this->storage = Storage::disk('snapshots');
    }

    private function getSnapshots()
    {
        $snapshots = $this->storage->listContents();
        usort($snapshots, function($a,$b) {
            if ($a['timestamp'] == $b['timestamp']) {
                return 0;
            }
            return ($a['timestamp'] > $b['timestamp']) ? -1 : 1;
        });
        return $snapshots;
    }

    /**
     * Display a listing of the SnapshotsAPIController.
     * GET|HEAD /snapshotsAPIControllers
     *
     * @return Response
     */
    public function view()
    {
        // dd($snapshots);
        return $this->sendResponse($this->getSnapshots(), 'Backups recuperados satisfactoriamente');
    }

    /**
     * Store a newly created Snapshots in storage.
     * POST /snapshots
     *
     * @param String $name
     *
     * @return Response
     */
    public function create(String $name = null)
    {
        if($name != null){
            Artisan::call('snapshot:create',['name' => $name]);
    } else{
            Artisan::call('snapshot:create');
        }

        return $this->sendResponse($this->getSnapshots(), 'Backup creado satisfactoriamente');
    }

        /**
     * Store a newly created Snapshots in storage.
     * POST /snapshots
     *
     * @param String $name
     *
     * @return Response
     */
    public function restore(String $name)
    {
        Artisan::call('snapshot:load',['name' => $name]);
        return $this->sendResponse('', 'Backup cargado satisfactoriamente');
    }

    /**
     * Remove the specified Snapshots from storage.
     * DELETE /snapshots
     *
     * @param  String $name
     *
     * @return Response
     */
    public function destroy(String $name)
    {
        $exist = $this->storage->has($name.'.sql');

        if (!$exist) {
            return $this->sendError('El backup solicitado no se encuentra');
        }

        Artisan::call('snapshot:delete',['name' => $name]);
        return $this->sendResponse('', 'Backup eliminado satisfactoriamente');
    }
}
