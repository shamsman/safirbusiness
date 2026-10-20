<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectWwwToApex
{
    /**
     * Redirect www.safirbusinesshub.com requests to the canonical apex domain https://safirbusinesshub.com.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->getHost() === 'www.safirbusinesshub.com') {
            return redirect()->to(
                'https://safirbusinesshub.com' . $request->getRequestUri(),
                301
            );
        }

        return $next($request);
    }
}
