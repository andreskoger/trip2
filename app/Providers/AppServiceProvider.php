<?php

namespace App\Providers;

use Analytics;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Guard $auth)
    {
        $this->google_analytics_track($auth);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Carbon::setLocale(config('app.locale'));

        Collection::macro('render', function ($callback = false) {
            $renderable = $this;

            if ($callback) {
                $renderable = $this->map($callback);
            }

            return $renderable->map(function ($item) {
                return (string) $item;
            });
        });

        Collection::macro('withoutLast', function () {
            return $this->slice(0, $this->count() - 1);
        });

        Collection::macro('onlyLast', function ($count = 1) {
            return $this->reverse()->slice(0, $count)->reverse();
        });

        Collection::macro('withoutLastWhenOdd', function () {
            return ($this->count() % 2 > 0) ? $this->withoutLast() : $this;
        });

        Collection::macro('withoutFirst', function () {
            return $this->slice(1, $this->count());
        });

        Collection::macro('pushWhen', function ($condition, $item) {
            if ($condition) {
                $this->push($item);
            }

            return $this;
        });

        Collection::macro('putWhen', function ($condition, $key, $item) {
            if ($condition) {
                $this->put($key, $item);
            }

            return $this;
        });
    }

    protected function google_analytics_track($auth)
    {
        view()->composer('layouts.main', function () use ($auth) {
            if ($auth->check()) {
                Analytics::setUserId($auth->user()->id);
                Analytics::trackCustom("ga('set', 'user_role', '".$auth->user()->role."');");
            }
        });
    }
}
