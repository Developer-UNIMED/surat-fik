<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jenis_surat', function (Blueprint $table) {
            $table->string('id', 36)->primary();
//            $table->foreignUuid('validator_role_id')->constrained('roles');
            $table->string('nama');
            $table->string('icon_path');
            $table->string('file_path');
            $table->text('deskripsi')->nullable();

            $table->foreignUuid('created_by')->constrained('users');
            $table->foreignUuid('updated_by')->constrained('users');
            $table->foreignUuid('deleted_by')->nullable()->constrained('users');

            $table->dateTime('created_at')->useCurrent();
            $table->dateTime('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->dateTime('deleted_at')->nullable();
        });

        Schema::create('surat_masuk', function (Blueprint $table) {
            $table->string('id', 36)->primary();
            $table->foreignUuid('jenis_surat_id')->constrained('jenis_surat');
            $table->string('file_path');

            $table->foreignUuid('created_by')->constrained('users');
            $table->foreignUuid('updated_by')->constrained('users');
            $table->foreignUuid('deleted_by')->nullable()->constrained('users');

            $table->dateTime('created_at')->useCurrent();
            $table->dateTime('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->dateTime('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jenis_surat', function (Blueprint $table) {
            $table->dropForeign(['created_by', 'updated_by', 'deleted_by']);
        });
        Schema::dropIfExists('jenis_surat');
    }
};
