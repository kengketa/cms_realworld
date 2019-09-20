<?php

namespace App\Http\Middleware;

use Closure;
use App\Category;

class VerifyCategoriesCount
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
        $categories = Category::all();
        if($categories->count() == 0){
            session()->flash('error','Please Create a Category first');
            return redirect(route('categories.create'));
        }
        return $next($request);
    }
}
