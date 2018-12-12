<?php

namespace App\Http\Middleware;

use App\Company;
use App\Image;
use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class UserAuthentication
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
        foreach ($request->route()->parameters as $parameter){
            if ($parameter instanceof User){
                $id = $parameter->id;
            }
            if ($parameter instanceof Image){
                $id = $parameter->user_id;
            }
            if ($parameter instanceof Company){
                $id = $parameter->user_id;
            }
        }
        if(Auth::id() != $id){
            return redirect()->route('home');
        }
        return $next($request);
    }
}
