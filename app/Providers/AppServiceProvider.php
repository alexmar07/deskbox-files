<?php

namespace App\Providers;

use App\Models\File;
use App\Http\Services\FileService;
use Illuminate\Support\ServiceProvider;
use App\Http\Repositories\FileRepository;
use App\Http\Contracts\Services\FileServiceContract;
use App\Http\Contracts\Repositories\FileRepositoryContract;

class AppServiceProvider extends ServiceProvider {


    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {

    }
}
