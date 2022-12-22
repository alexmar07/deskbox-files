<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->uuid('hash');
            $table->longText('path');
            $table->enum('type', ['txt', 'generic', 'music', 'video', 'image'])->nullable();
            $table->boolean('is_folder')->default(false);
            $table->decimal('size', 12, 2, true);
            $table->smallInteger('n_files', unsigned: true)->default(0);
            $table->uuid('directory_id')->nullable();
            $table->uuid('user_id');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('directory_id')->references('id')->on('files')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('files');
    }
};
