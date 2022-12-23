<?php

namespace App\Providers;

use App\Models\File;
use App\Http\Services\FileService;
use Illuminate\Support\ServiceProvider;
use App\Http\Repositories\FileRepository;
use App\Http\Contracts\Services\FileServiceContract;
use App\Http\Contracts\Repositories\FileRepositoryContract;

class AppServiceProvider extends ServiceProvider {

    protected $repositories = [
        FileRepositoryContract::class => [
            'concrete' => FileRepository::class,
            'model' => File::class,
        ]
    ];

    protected $services = [
        FileServiceContract::class => [
            'repository'    => FileRepositoryContract::class,
            'service'       => FileService::class
        ]
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {

        foreach($this->repositories as $abstract => $impl) {
            app()->bind($abstract, function ($app) use ($impl) {
                return new $impl['concrete'](new $impl['model']);
            });
        }

        foreach ($this->services as $abstract => $impl) {
            app()->bind($abstract, function ($app) use ($impl) {
                return new $impl['service']($app->make($impl['repository']));
            });
        }
    }
}
