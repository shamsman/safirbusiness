<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  ...$roles
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();

        if (!$user) {
            return redirect()->route('login');
        }

        // Normalize roles list
        $allowed = [];
        foreach ($roles as $role) {
            foreach (explode(',', $role) as $subRole) {
                $trimmed = strtolower(trim($subRole));
                if ($trimmed !== '') {
                    $allowed[] = $trimmed;
                }
            }
        }

        if (!empty($allowed) && !in_array($user->role->value, $allowed, true)) {
            abort(403, 'Unauthorized: You do not possess the required privileges to view this section.');
        }

        return $next($request);
    }
}
