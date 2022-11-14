<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Session\Store;

class AutoLogout
{
    protected $session;
    protected $timeout = 3000;
    public function __construct(Store $session)
    {
        $this->session = $session;
    }

    public function handle(Request $request, Closure $next)
    {
      if(!session('last_active')) {
            $this->session->put('last_active', time());
        } elseif(time() - $this->session->get('last_active') > $this->timeout) {
            $this->session->forget('last_active');
            auth()->logout();
            return redirect('/login');
        }
        return $next($request);
    }
}