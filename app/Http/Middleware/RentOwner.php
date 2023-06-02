<?php

namespace App\Http\Middleware;

use App\Models\Rents;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RentOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $id_renter = Rents::findOrFail($request->id)->user_id;
        $user = Auth::user()->id;
        
        
        if ($id_renter != $user) {
            return response()->json('you are not the renter of this plane');
        }

        return $next($request);
    }
}
