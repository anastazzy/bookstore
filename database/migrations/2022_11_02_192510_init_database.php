<?php

use App\Models\Role;
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
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name', 128)->unique();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('role_id')->default(1);
            $table->foreign('role_id')
                ->references('id')
                ->on('roles')
                ->cascadeOnDelete();
            $table->string('last_name', 128);
            $table->string('first_name', 128);
            $table->string('patronymic', 128)->nullable();
            $table->date('birthday')->nullable();
            $table->string('phone', 11)->unique();
            $table->string('password', 128);
            $table->string('email', 320)->unique();
            $table->string('remember_token', 256)->nullable();
        });

        Role::query()->insert([
            ['name' => 'покупатель'],
            ['name' => 'продавец'],
            ['name' => 'администратор']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop("roles");
        Schema::drop("users");
    }
};
