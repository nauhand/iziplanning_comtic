<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImageToAgents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('agents', function (Blueprint $table) {
            $table->string('titre_sejour')->nullable();
            $table->string('titre_sejour_verso')->nullable();
            $table->string('carte_vitale')->nullable();
            $table->string('carte_vitale_verso')->nullable();
            $table->string('permis_conduire')->nullable();
            $table->string('permis_conduire_verso')->nullable();
            $table->string('piece_identite')->nullable();
            $table->string('piece_identite_verso')->nullable();
            $table->string('passport')->nullable();
            $table->string('passport_verso')->nullable();
            $table->string('carte_nationale')->nullable();
            $table->string('carte_nationale_verso')->nullable();
            $table->string('recepice_titre_sejour')->nullable();
            $table->string('carte_vaccin_chien')->nullable();
            $table->string('carte_professionnelle')->nullable();

            $table->string('ville')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('agents', function (Blueprint $table) {
            //
        });
    }
}
