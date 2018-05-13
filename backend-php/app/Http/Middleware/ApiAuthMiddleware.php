<?php

namespace App\Http\Middleware;

use App\Repositories\Interfaces\IIdentityRepo;
use Closure;

class ApiAuthMiddleware
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
        $access_token = $request->headers->get('access_token');

        /** @var IIdentityRepo $identityRepo */
        $identityRepo = app(IIdentityRepo::class);

        $proxyIdentityId = $identityRepo->proxyIdByAccessToken($access_token);
        $proxyIdentityState = $identityRepo->proxyStateById($proxyIdentityId);
        $identityId = $identityRepo->identityIdByProxyId($proxyIdentityId);

        if ($access_token && $proxyIdentityState != 'active') {
            switch ($proxyIdentityState) {
                case 'pending': {
                    return response()->json([
                        "error" => 'proxy_identity_pending'
                    ])->setStatusCode(401);
                } break;
            }
        }

        if (!$access_token || !$proxyIdentityId || !$identityId) {
            return response()->json([
                "error" => 'invalid_access_token'
            ])->setStatusCode(401);
        }

        $request->attributes->set('identity', $identityId);
        $request->attributes->set('proxyIdentity', $proxyIdentityId);

        return $next($request);
    }
}
