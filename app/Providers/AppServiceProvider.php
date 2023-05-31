<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\PendingRequest;

/**
 * Class AppServiceProvider
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Set bindings
     *
     * @var array
     */
    public $bindings = [
        \App\Wrappers\Hackernews\HackerNewsManagerInterface::class => \App\Wrappers\Hackernews\HackerNewsManager::class,
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->defineHttpMacro();
    }

    /**
     * Define http macro calls
     *
     * @return void
     */
    private function defineHttpMacro(): void
    {
        /**
         * Set HTTP macro for Hacker News api
         *
         * @see \Illuminate\Support\Facades\Http
         * @see \Illuminate\Http\Client\PendingRequest
         */
        Http::macro('HackerNews', function (): PendingRequest {
            return Http::baseUrl('https://hacker-news.firebaseio.com/v0')
                ->acceptJson()
                ->contentType('application/json')
                ->withUrlParameters(['print' => 'pretty']);
        });
    }
}
