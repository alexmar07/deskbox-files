<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class File extends Model {

    use HasUuids;

    protected $fillable = [
        'name',
        'ext',
        'hash',
        'path',
        'type',
        'is_folder',
        'size',
        'n_files',
        'directory_id',
        'user_id'
    ];

    protected $attributes = [
        'type'          => null,
        'is_folder'     => false,
        'n_files'       => 0,
        'directory_id'  => null
    ];
}
