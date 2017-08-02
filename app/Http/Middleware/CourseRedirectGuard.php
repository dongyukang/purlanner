<?php

namespace App\Http\Middleware;

use Closure;

class CourseRedirectGuard
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
      if (auth()->user()->courses()->count() > 0) {
        return $next($request);
      }

      return redirect('/settings')->with('flash', 'You need to have at least one course saved.')
                                  ->with('type', 'danger');
    }
}
