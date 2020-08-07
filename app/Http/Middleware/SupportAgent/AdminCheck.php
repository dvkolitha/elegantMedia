<?php

namespace App\Http\Middleware\SupportAgent;

use App\Guest\GuestTicket;
use Closure;

class AdminCheck
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

            if (auth()->user()->is_support_agent == 0) {
                $guestReference = GuestTicket::where('email',auth()->user()->email)->first();
                return redirect('tickets/'.$guestReference->id.'');
            }

            return $next($request);
        }
}
