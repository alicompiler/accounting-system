<?php

namespace App\Http\Middleware;

use App\Http\Controllers\LoginController;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class AuthMiddleware {

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        $username = $request->session()->get(LoginController::USERNAME_KEY);

        if ($username) {
            $employee = User::where("username", $username)->first();
            if ($employee) {
                $request->attributes->add(["user" => $employee]);
                return $next($request);
            }
        }

        return redirect(route("login"));
    }
}
