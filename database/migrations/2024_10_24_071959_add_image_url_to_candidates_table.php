<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('candidates', function (Blueprint $table) {
        $table->string('image_url')->nullable(); // Menambahkan kolom image_url, nullable karena tidak wajib diisi
    });
}

public function down()
{
    Schema::table('candidates', function (Blueprint $table) {
        $table->dropColumn('image_url'); // Menghapus kolom jika rollback
    });
}

};
