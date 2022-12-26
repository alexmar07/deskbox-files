<?php namespace App\Http\Contracts\Repositories;

/**
 * Interfaccia per la definizione delle funzioni
 * del repository di un file
 */
interface UserRepositoryContract {

    //---------------------------------------------------------------------------------------------------

    /**
     * Restituisce la cartella dell'utente in base
     * all'id
     *
     * @access public
     *
     * @param string $userId    ID utente
     *
     * @return string
     */
    public function getFolderByUserId(string $userId) : string;

    //---------------------------------------------------------------------------------------------------
}
