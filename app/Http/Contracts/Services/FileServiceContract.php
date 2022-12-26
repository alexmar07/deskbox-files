<?php namespace App\Http\Contracts\Services;

use Illuminate\Http\UploadedFile;

/**
 * Interfaccia per la definizione delle funzioni del servizio
 * per i file
 */
interface FileServiceContract {

    //---------------------------------------------------------------------------------------------------

    /**
     * Carica i file nello storage
     *
     * @param array|UploadedFile $files File da caricare
     *
     * @return \App\Models\File[]  Lista dei file da caricati
     */
    public function upload(array|UploadedFile $files) : array;

    //---------------------------------------------------------------------------------------------------

}
