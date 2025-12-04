<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureStudentIsActive
{
    public function handle(Request $request, Closure $next)
    {
        // If using a custom guard, e.g. 'student', change to Auth::guard('student')->check()
        if (Auth::check()) {
            $user = Auth::user();

            // Adjust field name if different
            if ((int)($user->isDelete ?? 0) === 1) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                // Web: redirect to login with message
                if (!$request->expectsJson()) {
                    return redirect()->route('FrontLogin')
                        ->withErrors(['account' => 'Your account has been deactivated.']);
                }

                // API/AJAX: return JSON 401 so SPA can redirect
                return response()->json([
                    'message' => 'Account deactivated',
                ], 401);
            }
        }

        return $next($request);
    }
}
