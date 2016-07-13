<?php

namespace yupiventas\Http\Middleware;
use Illuminate\Contracts\Auth\Guard;

use Closure;
use Session;
use Auth;

class mdwAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    protected $auth;

    /*public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }*/
    
    public function handle($request, Closure $next)
    {

        $user = $request->user();

        if(! $user || $user->type != 'Administrador'  )
        {
            #return 'no login';
            #Session::flash('message-error','No tiene privilegios');
            return redirect()->to('/login')->with('message-error','No tiene privilegios');
        }
        return $next($request);
    }
}
