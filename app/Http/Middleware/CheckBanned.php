<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckBanned
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
        
        if(auth('web')->check() && (auth('web')->user()->status == 0)){

            Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('admin.show_login_form')->with('error', 'Your Account is suspended, please contact Admin.');
}
    // }elseif(auth('customer')->check() && auth('customer')->user()->status == 0){
                
    //         Auth::logout();

    //     $request->session()->invalidate();

    //     $request->session()->regenerateToken();
    //             return redirect()->route('customer.show_login_form')->with('error', 'Your Account is suspended, please contact Admin.');

    // }

        return $next($request);
    }
}
