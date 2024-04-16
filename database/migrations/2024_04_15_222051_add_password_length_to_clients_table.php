<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPasswordLengthToClientsTable extends Migration
{
    public function up()
    {
        Schema::table('clients', function (Blueprint $table) {
            // Ajouter la colonne password_length comme un entier nullable
            $table->integer('password_length')->nullable();
        });
    }

    public function down()
    {
        Schema::table('clients', function (Blueprint $table) {
            // Supprimer la colonne password_length si elle existe
            $table->dropColumn('password_length');
        });
    }
}
