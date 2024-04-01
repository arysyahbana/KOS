<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                // ->group(function () {
                //     if (Auth::check()) {
                //         $role = Auth::user()->role;
                //         if ($role === 'Admin') {
                //             Route::get('/home-admin', function () {
                //                 return view('admin.index');
                //             });
                //         } elseif ($role === 'Owner') {
                //             Route::get('/', function () {
                //                 return redirect('/dashboard');
                //             });
                //             Route::get('/dashboard', function () {
                //                 return view('dashboard');
                //             })->name('dashboard');
                //         }
                //     } else {
                //         Route::get('/', function () {
                //             return view('welcome');
                //         });
                //     }
                // });
                ->group(base_path('routes/web.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     */
    protected function configureRateLimiting(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
