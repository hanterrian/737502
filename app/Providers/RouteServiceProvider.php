<?php

namespace App\Providers;

use App\Repositories\AuthorRepository;
use App\Repositories\BookRepository;
use App\Repositories\PublisherRepository;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });

        Route::bind('author', function ($value) {
            $repository = $this->app->make(AuthorRepository::class);

            return $repository->one($value);
        });

        Route::bind('publisher', function ($value) {
            $repository = $this->app->make(PublisherRepository::class);

            return $repository->one($value);
        });

        Route::bind('book', function ($value) {
            $repository = $this->app->make(BookRepository::class);

            return $repository->one($value);
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
