<?php

namespace App\Http\Middleware;

use App\Models\Family;
use App\Models\User;
use App\Service\MixedConnection;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use LaravelEnso\Companies\Models\Company;
// use App\Models\enso\companies\Company;
use LaravelEnso\Multitenancy\Services\Tenant;

class Multitenant
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
//        $tenatDB=\App\Models\Tenant::where('id',Auth::id())->get();
//        Log::debug();
        $conn = \Session::get('conn');
        //$value = \Session::get('db');
        $value = 'tenants_'.Auth::id();
        Log::debug($value);
        session()->put('db', $value);
        //if ($conn === 'tenant') {
            $key = 'database.connections.tenantdb.database';
           $x= config([$key => $value]);
           //Family::setConnection();
           // config(['database.default'=>'tenant']);
        /*}/*else {
            config(['database.default'=>'mysql']);
        }*/

        /*if ($request->has('_tenantId')) {
            $request->request->remove('_tenantId');
        }*/
        return $next($request);
    }

    private function ownerRequestsTenant($request)
    {
        return $request->user()->isSupervisor();
        // && $request->has('_tenantId');
    }
}
