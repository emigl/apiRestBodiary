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
        
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('role_id')->after('id')->constrained()->OnDelete('cascade');
        });

        Schema::table('body_imcs', function (Blueprint $table) {
            $table->foreignId('user_id')->after('id')->constrained()->onDelete('cascade');
        });

        Schema::table('body_weights', function (Blueprint $table) {
            $table->foreignId('user_id')->after('id')->constrained()->onDelete('cascade');
        });

        Schema::table('progress_weights', function (Blueprint $table) {
            $table->foreignId('user_id')->after('id')->constrained()->onDelete('cascade');
            $table->foreignId('training_exercise_id')->after('id')->constrained()->onDelete('cascade');
        });
    
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
