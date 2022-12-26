<?php namespace App\Http\Repositories;

use App\Models\File;
use App\Http\Contracts\Repositories\FileRepositoryContract;
use Illuminate\Support\Str;

/**
 * Repository per la gestione dei file
 *
 * @implements \App\Http\Contracts\Repositories\FileRepositoryContract
 */
class FileRepository implements FileRepositoryContract {

    /**
     * Modello per la gestione dei file
     *
     * @var \App\Models\File
     */
    private File $file;

    //---------------------------------------------------------------------------------------------------

    /**
     * Costruttore
     *
     * @param File $file
     */
    public function __construct(File $file) {
        $this->file = $file;
    }

    //---------------------------------------------------------------------------------------------------

    public function generateUniqueHash() : string {

        $hash = Str::uuid();

        do {
            $file = $this->getByHash($hash);
        }
        while (is_null($file));

        return $hash;
    }

    //---------------------------------------------------------------------------------------------------

    public function getByHash(string $hash) : File|null {
        return $this->file->where('hash', '=', $hash)->get();
    }

    //---------------------------------------------------------------------------------------------------

    public function store (array $data) : File {
        return $this->file->create($data);
    }

    //---------------------------------------------------------------------------------------------------
}