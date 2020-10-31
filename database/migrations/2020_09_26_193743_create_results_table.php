<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('results', function (Blueprint $table) {
            $table->id('results_id');
            $table->string('stream');
            $table->string('upi');
            $table->integer('composition');
            $table->integer('grammah');
            $table->integer('insha');
            $table->integer('lugha');
            $table->integer('mathematics');
            $table->integer('science');
            $table->integer('social_studies');
            $table->integer('religious_education');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('results');
    }
}
