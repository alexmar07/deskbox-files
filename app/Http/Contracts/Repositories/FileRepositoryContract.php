<?php namespace App\Http\Contracts\Repositories;

use App\Models\File;

/**
 * Interfaccia per la definizione delle funzioni
 * del repository di un file
 */
interface FileRepositoryContract {

    //---------------------------------------------------------------------------------------------------

    /**
     * Crea il file nel DB
     *
     * @access public
     *
     * @param array $data
     *
     * @return File
     */
    public function store(array $data): File;

    //---------------------------------------------------------------------------------------------------
    /**
     * Restituisce l'identificativo univoco un nuovo file
     *
     * @access public
     *
     * @return string
     */
    public function generateUniqueHash() : string;

    //---------------------------------------------------------------------------------------------------

    /**
     * Recupera un file tramite il suo identificativo hash
     *
     * @access public
     *
     * @param string $hash
     *
     * @return \App\Models\File|null
     */
    public function getByHash(string $hash) : ?File;
}
