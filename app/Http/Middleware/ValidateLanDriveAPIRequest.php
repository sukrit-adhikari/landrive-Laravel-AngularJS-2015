<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Input;
use App\User;
use App\Http\Controllers\LanDriveTokenController;

class ValidateLanDriveAPIRequest {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{

      if(!LanDriveTokenController::requestHasValidToken()){
//        return response()->json(['Status' => 0, 'Code' => 403, 'Message' => 'Invalid or Unauthorized Request!' ]);
      }

      return $next($request);
	}



}
