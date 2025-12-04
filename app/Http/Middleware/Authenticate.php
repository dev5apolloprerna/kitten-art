<?php


// app/Http/Middleware/Authenticate.php
namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Route;

class Authenticate extends Middleware
{
    protected array $guardsForCurrentRequest = [];

    public function handle($request, \Closure $next, ...$guards)
    {
        $this->guardsForCurrentRequest = $guards;
        return parent::handle($request, $next, ...$guards);
    }

    protected function redirectTo($request)
    {
        if ($request->expectsJson()) {
            return null;
        }

        // If this route was protected with auth:student, redirect to student login
        if (in_array('student', $this->guardsForCurrentRequest, true)) {
            return route('FrontLogin');
        }

        // Fallback: admin/staff login
        return route('login'); // your existing admin login route name
    }
}
