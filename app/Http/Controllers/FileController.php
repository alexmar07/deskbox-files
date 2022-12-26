<?php namespace App\Http\Controllers;

use App\Http\Contracts\Services\FileServiceContract;
use Illuminate\Http\Request;

/**
 * Controller per la gestione dei file
 *
 */
class FileController extends Controller {

    /**
     * Service per la gestione dei file
     *
     * @var \App\Http\Contracts\Services\FileServiceContract
     */
    private FileServiceContract $fileService;


    /**
     * Summary of __construct
     * @param FileServiceContract $fileService
     */
    public function __construct(FileServiceContract $fileService) {
        $this->fileService = $fileService;
    }

    public function upload(Request $request ) {

        if ( ! $request->hasFile('files') ) {
            return responseFail(__('file_response.file_required'));
        }

        $uploaded = $this->fileService->upload($request->file('files'));

    }
}
