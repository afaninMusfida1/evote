<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUniqueConstraintToVotesTable extends Migration
{
    public function up()
    {
        Schema::table('votes', function (Blueprint $table) {
            $table->unique(['voter_id', 'candidate_id']);
        });
    }

    public function down()
    {
        Schema::table('votes', function (Blueprint $table) {
            $table->dropUnique(['voter_id', 'candidate_id']);
        });
    }
}
