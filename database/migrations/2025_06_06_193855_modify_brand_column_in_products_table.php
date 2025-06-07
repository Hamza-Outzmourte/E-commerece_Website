<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyBrandColumnInProductsTable extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            // Si la colonne 'brand' existe en varchar, la supprimer d'abord
            $table->dropColumn('brand');

            // Ajouter la colonne brand_id en unsignedBigInteger (assumant que brands.id est un bigInteger)
            $table->unsignedBigInteger('brand_id')->nullable()->after('category_id');

            // Ajouter la clé étrangère vers brands.id
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            // Supprimer la clé étrangère et la colonne brand_id
            $table->dropForeign(['brand_id']);
            $table->dropColumn('brand_id');

            // Réajouter la colonne brand (varchar)
            $table->string('brand')->nullable()->after('category_id');
        });
    }
}
