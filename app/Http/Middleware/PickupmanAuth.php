<?php

namespace App\Http\Middleware;

use Closure;
Use Session;
use App\Pickupman;

class PickupmanAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $validAgent=Pickupman::where(['id'=>Session::get('pickupmanId'),'status'=>1])->first();
        if ($validAgent!=NULL) {
            return $next($request);     
        }
        return redirect('pickupman/login');
    }
}
