<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNomorUrutImageVisiMisiToCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::table('candidates', function (Blueprint $table) {
        // Komentari atau hapus penambahan kolom yang sudah ada
        // $table->integer('nomor_urut')->default(1)->after('name')->nullable(false);
        // $table->string('image')->nullable(false)->after('nomor_urut');

        // Tambah kolom lain yang belum ada
        if (!Schema::hasColumn('candidates', 'visi_misi')) {
            $table->text('visi_misi')->nullable(false)->after('image');
        }
    });
}



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('candidates', function (Blueprint $table) {
            $table->dropColumn('nomor_urut');
            $table->dropColumn('image');
            $table->dropColumn('visi_misi');
        });
    }
}
