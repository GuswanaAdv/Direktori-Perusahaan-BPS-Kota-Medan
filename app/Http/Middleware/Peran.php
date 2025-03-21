<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Peran
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $id_peran)
    {
        if ($request->user()->id_peran == $id_peran) {
            return $next($request);
        }

        abort(403, 'Anda tidak memiliki hak mengakses laman tersebut!');
    }
}
