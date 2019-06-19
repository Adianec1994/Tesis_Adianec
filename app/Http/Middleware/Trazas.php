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
        if(in_array($request->method(),['POST','PUT','DELETE']))
            {
                // $traza['fecha'] = date('d-m-Y');
                // $traza['hora'] = date('H:i:s A');
                $traza['accion'] = $request->method();
                $traza['ip'] = $request->ip();
                $traza['url'] = $request->path();

                $new = $this->trazaRepo->create($traza);
                $request->user() != null ? $request->user()->trazas()->save($new) : null;
            }

        return $next($request);
    }
}
