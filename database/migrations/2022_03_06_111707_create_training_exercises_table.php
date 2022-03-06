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
        Schema::create('training_exercises', function (Blueprint $table) {
            $table->id();
            $table->string('name', 80);
            $table->string('muscle', 80)->nullable();
            $table->integer('reps')->nullable();
            $table->integer('sets')->nullable();
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
        Schema::dropIfExists('training_exercises');
    }
};
