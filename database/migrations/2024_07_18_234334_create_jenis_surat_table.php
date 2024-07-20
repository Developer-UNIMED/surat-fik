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
            $table->uuid('id')->primary();
            $table->string('nama_surat');
            $table->string('icon_surat');
            $table->string('file_surat');

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
