<?php

namespace App\Http\Middleware;

use Closure;

class RedirectGuard
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
      date_default_timezone_set("America/New_York");

      if (auth()->user()->tasks()->whereDate('due_date', '>=', \Carbon\Carbon::today())->count() > 0) {
        return $next($request);
      }

      return redirect()->back()->with('flash', 'You need to have at least one task saved.')->with('type', 'danger');
    }
}
