<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVotesTable extends Migration
{
    public function up()
    {
        Schema::create('votes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('candidate_id')->constrained()->onDelete('cascade');
            $table->foreignId('voter_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            // Add a unique constraint to ensure one vote per user per candidate
            $table->unique(['voter_id', 'candidate_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('votes');
    }
}
