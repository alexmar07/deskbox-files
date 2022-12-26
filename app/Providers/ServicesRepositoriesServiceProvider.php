<?php

namespace App\Providers;

use App\Models\File;
use App\Http\Services\FileService;
use Illuminate\Support\ServiceProvider;
use App\Http\Repositories\FileRepository;
use App\Http\Contracts\Services\FileServiceContract;
use App\Http\Contracts\Repositories\FileRepositoryContract;
use App\Http\Contracts\Repositories\UserRepositoryContract;
use App\Http\Contracts\Services\AuthServiceContract;
use App\Http\Repositories\UserRepository;

/**
 * Provider per la registrazione dei servizi e dei repositories
 */
class ServicesRepositoriesServiceProvider extends ServiceProvider {

    protected $repositories = [
        FileRepositoryContract::class => [
            'concrete' => FileRepository::class,
            'model' => File::class,
        ],
        UserRepositoryContract::class => [
            'concrete'  => UserRepository::class,
            'model'     => User::class
        ]
    ];

    protected $services = [
        FileServiceContract::class => [
            'repository'    => FileRepositoryContract::class,
            'service'       => FileService::class
        ],
        AuthServiceContract::class  => [
            'repository'    => UserRepositoryContract::class,
            'service'       => AuthService::class
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
