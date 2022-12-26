<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Contracts\Services\AuthServiceContract;

/**
 * Controller per la gestione dell'autenticazione
 *
 */
class AuthController extends Controller {

    protected AuthServiceContract $authService;

    public function __construct(AuthServiceContract $authService) {
        $this->authService = $authService;
    }

    public function register (Request $request) {

        $user = $this->authService->register($request->all());


    }
}
