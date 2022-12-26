<?php namespace App\Http\Repositories;

use App\Models\User;
use App\Http\Contracts\Repositories\UserRepositoryContract;

/**
 * Repository per la gestione degli utenti
 *
 * @implements \App\Http\Contracts\Repositories\UserRepositoryContract
 */
class UserRepository implements UserRepositoryContract {

    /**
     * Modello per la gestione deglu utenti
     *
     * @var \App\Models\User
     */
    private User $user;

    //---------------------------------------------------------------------------------------------------

    /**
     * Costruttore
     *
     * @param \App\Models\User $user
     */
    public function __construct(User $user) {
        $this->user = $user;
    }

    //---------------------------------------------------------------------------------------------------

    public function getFolderByUserId(string $userId) : string {
        return $this->user->find($userId)->folder;
    }

    //---------------------------------------------------------------------------------------------------
}