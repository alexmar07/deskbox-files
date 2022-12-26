<?php namespace App\Http\Services;

use Illuminate\Http\File as IlluminateFile;
use App\Models\File as File;
use Illuminate\Http\UploadedFile;
use App\Http\Contracts\Services\FileServiceContract;
use App\Http\Contracts\Repositories\FileRepositoryContract;
use App\Http\Contracts\Repositories\UserRepositoryContract;

/**
 * Servizio per la gestione dei file
 *
 * @implements \App\Http\Contracts\Services\FileServiceContract
 */
class FileService implements FileServiceContract{

    /**
     * Repository per la gestione dei file
     *
     * @access private
     * @var \App\Http\Contracts\Repositories\FileRepositoryContract
     */
    private FileRepositoryContract $repository;

    //---------------------------------------------------------------------------------------------------

    /**
     * Costruttore
     *
     * @param FileRepositoryContract $repository
     */
    public function __construct(FileRepositoryContract $repository) {
        $this->repository = $repository;
    }

    //---------------------------------------------------------------------------------------------------

    public function upload(array|UploadedFile $files) : array {

        $fileUploaded = [];

        $userRepository = app()->make(UserRepositoryContract::class);

        $userFolder = $userRepository->getFolderByUserId(auth()->user()->id);

        foreach ($files as $file) {

            $hash = $this->repository->generateUniqueHash();

            $file->storeAs($userFolder, $hash);

            $fileUploaded[] = $this->store($file, $hash);
        }

        return [];
    }

    //---------------------------------------------------------------------------------------------------

    public function store(UploadedFile $file, string $hash) : File {

        $data = [
            'name'  => $file->getClientOriginalName(),
            'ext'   => $file->getExtension(),
            'hash'  => $hash,
            'path'  => null,
            'type'  => $this->getFileType($file->getMimeType()),
            'size'  => $file->getSize(),
        ];

        $stored = $this->repository->store($data);

        return $stored;

    }

    //---------------------------------------------------------------------------------------------------

    private function getFileType(string $mimeType) : string {

        [$type, $extra] = explode('/', $mimeType);

        return match ($type) {
            'text'  => 'txt',
            'audio' => 'audio',
            'video' => 'video',
            'image' => 'image',
            default => 'generic'
        };
    }

    //---------------------------------------------------------------------------------------------------

}