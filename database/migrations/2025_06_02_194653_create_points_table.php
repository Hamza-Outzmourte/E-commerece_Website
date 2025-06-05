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
        Schema::create('points', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('points')->default(0);
            $table->string('description')->nullable(); // Optionnel, pour préciser pourquoi on ajoute/enlève des points
            $table->timestamps();
        });
        
    }

    public function down()
    {
        Schema::dropIfExists('points');
    }

};
