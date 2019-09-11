<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Repositories\TrazaRepository;

class Trazas
{
    private $trazaRepo;

    public function __construct(TrazaRepository $trazaRepository)
    {
      $this->trazaRepo = $trazaRepository;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $path = explode("/",$request->path());
        if($path[1] !== 'login') {
            if ($path[1] !== 'logout') {
                if (in_array($request->method(), ['POST', 'PUT', 'DELETE'])) {
                    // $traza['fecha'] = date('d-m-Y');
                    // $traza['hora'] = date('H:i:s A');
                    $traza['accion'] = $this->translate($request->method());
                    $traza['ip'] = $request->ip();
                    $traza['url'] = $request->path();

                    $new = $this->trazaRepo->create($traza);
                    $request->user() != null ? $request->user()->trazas()->save($new) : null;
                }
            }
        }
        return $next($request);
    }

    private function translate($method)
    {
        switch ($method){
            case 'POST':
                return 'Crear';
                break;
            case 'PUT':
                return 'Actualizar';
                break;
            case 'DELETE':
                return 'Eliminar';
                break;
        }
    }
}
