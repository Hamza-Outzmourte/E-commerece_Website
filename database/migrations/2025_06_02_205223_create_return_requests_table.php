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
        Schema::create('return_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade'); // la commande concernée
            $table->foreignId('user_id')->constrained()->onDelete('cascade');  // l’utilisateur qui fait la demande
            $table->string('reason');    // raison du retour
            $table->text('details')->nullable(); // détails optionnels
            $table->string('status')->default('pending'); // pending, approved, rejected
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('return_requests');
    }
};
