<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogActivityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
       {
           Schema::create('log_activity', function (Blueprint $table) {
               $table->bigIncrements('id');
               $table->string('subject');
               $table->string('url');
               $table->string('method');
               $table->string('ip');
               $table->string('agent')->nullable();
               $table->string('pays')->nullable();
               $table->string('ville')->nullable();
               $table->string('region')->nullable();
               $table->string('table')->nullable();
               $table->unsignedBigInteger('severity_level')->nullable();
               $table->unsignedBigInteger('table_id')->nullable();
               $table->unsignedBigInteger('user_id')->nullable();
               $table->timestamps();
               $table->foreign('user_id')->references('id')->on('users')
               ->onDelete('cascade')
               ->onUpdate('cascade');
           });
       }
       /**
        * Reverse the migrations.
        *
        * @return void
        */
       public function down()
       {
           Schema::dropIfExists('log_activity');
       }
}
