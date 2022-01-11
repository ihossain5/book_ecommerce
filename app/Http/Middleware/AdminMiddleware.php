<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware {
    public $user;

    public function __construct() {
        $this->user = auth()->user();
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next) {
        if ($this->user->is_admin != 0 ) {
            return $next($request);
        } else {
            return redirect()->route('frontend.home')->with('error', 'You have no permission to access this');
        }
    }
}
