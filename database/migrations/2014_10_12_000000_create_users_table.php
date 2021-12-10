<?php
use App\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nom');
            $table->string('prenoms');
            $table->string('email')->unique();
            $table->string('numeromobile');
            $table->unsignedBigInteger('media_id')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            /** si admin or manager **/
            $table->boolean('is_admin');
            $table->boolean('is_active');
            $table->rememberToken();
            $table->timestamps();
        });
        User::create([
            'nom'=>'Jean',
            'prenoms'=>'Yves',
            'email'=>'admin@bss.com',
            'numeromobile'=>'22508927943123',
            'is_admin'=>true,
            'is_active'=>true,
            'password'=>\Hash::make('adminbss2020'),
        ]);
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}