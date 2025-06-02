<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\App; // لاستخدام App::setLocale()
use Illuminate\Support\Facades\Session;

class LocalizationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->has('lang') && in_array($request->lang, ['en', 'ar'])) {
            App::setLocale($request->lang);
            Session::put('locale', $request->lang);
        }
        elseif ($request->header('Accept-Language')) {
            $locale = substr($request->header('Accept-Language'), 0, 2); 
            if (in_array($locale, ['en', 'ar'])) {
                App::setLocale($locale);
                Session::put('locale', $locale);
            }
        }
          elseif (Session::has('locale') && in_array(Session::get('locale'), ['en', 'ar'])) {
            App::setLocale(Session::get('locale'));
        }
        
        return $next($request);
    }
}