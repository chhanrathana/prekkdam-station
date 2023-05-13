<?php

namespace App\Http\Middleware;

use App\Enums\PermissionUrlEnum;
use App\Models\URL;
use App\Models\UserHasMenu;
use Illuminate\Http\Request;
use Closure;
use Illuminate\Support\Facades\Route;

class HasMenuAuthticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        $name = Route::currentRouteName();
        
        // $isAllow = URL::where('route_name', $name)
        // ->join('user_type_urls', 'urls.id', 'user_type_urls.url_id')
        // ->where('user_type_id', auth()->user()->user_type_id)
        // ->first();        
        // if(!$isAllow){
        //     return abort(403);            
        // }

        return $next($request);
    }
}
