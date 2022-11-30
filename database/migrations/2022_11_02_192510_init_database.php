<?php

use App\Models\Author;
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
        });

        Schema::create('statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name', 128)->unique();
        });

        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();
            $table->unsignedBigInteger('status_id')->default(1);
            $table->foreign('status_id')
                ->references('id')
                ->on('statuses')
                ->cascadeOnDelete();
            $table->date('placing_date')->nullable();
            $table->date('sale_date');
        });

        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->string('path', 256);
        });

        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('name', 512);
            $table->string('description', 2048);
            $table->unsignedBigInteger('file_id');
            $table->foreign('file_id')
                ->references('id')
                ->on('files');
            $table->double('purchase_price');
            $table->double('sale_price');
        });

        Schema::create('order_book', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')
                ->references('id')
                ->on('orders')
                ->cascadeOnDelete();
            $table->unsignedBigInteger('book_id');
            $table->foreign('book_id')
                ->references('id')
                ->on('books')
                ->cascadeOnDelete();
            $table->integer('count');
        });

        Schema::create('genres', function (Blueprint $table) {
            $table->id();
            $table->string('name', 128)->unique();
        });

        Schema::create('book_genre', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('book_id');
            $table->foreign('book_id')
                ->references('id')
                ->on('books')
                ->cascadeOnDelete();
            $table->unsignedBigInteger('genre_id');
            $table->foreign('genre_id')
                ->references('id')
                ->on('genres')
                ->cascadeOnDelete();
        });

        Schema::create('authors', function (Blueprint $table) {
            $table->id();
            $table->string('last_name', 128);
            $table->string('first_name', 128);
            $table->string('patronymic', 128)->nullable();
        });

        Schema::create('book_author', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('book_id');
            $table->foreign('book_id')
                ->references('id')
                ->on('books')
                ->cascadeOnDelete();
            $table->unsignedBigInteger('author_id');
            $table->foreign('author_id')
                ->references('id')
                ->on('authors')
                ->cascadeOnDelete();
        });

        Schema::create('warehouses', function (Blueprint $table) {
            $table->id();
            $table->string('country', 256);
            $table->string('region', 256);
            $table->string('city', 256);
            $table->string('street', 256);
            $table->integer('house');
            $table->string('building', 24)->nullable();
            $table->integer('flat');
        });

        Schema::create('book_warehouse', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('book_id');
            $table->foreign('book_id')
                ->references('id')
                ->on('books')
                ->cascadeOnDelete();
            $table->unsignedBigInteger('warehouse_id');
            $table->foreign('warehouse_id')
                ->references('id')
                ->on('warehouses')
                ->cascadeOnDelete();
            $table->integer('count');
        });

        Role::query()->insert([
            ['name' => 'покупатель'],
            ['name' => 'продавец'],
            ['name' => 'администратор']
        ]);

        Author::query()->insert([[
                'first_name' => 'Булгаков',
                'last_name' => 'Михаил',
                'patronymic' => 'Афанасьевич'
            ],
            [
                'first_name' => 'Достоевский',
                'last_name' => 'Федор',
                'patronymic' => 'Михайлович'
            ],
        ]);

        \App\Models\Status::query()->insert([
            ['name' => 'Оформлен'],
            ['name' => 'Собран'],
            ['name' => 'Оплачен']
        ]);

        \App\Models\Genre::query()->insert([
            ['name' => 'Ужасы/Триллер'],
            ['name' => 'Фантастика'],
            ['name' => 'Классика'],
            ['name' => 'Триллер'],
            ['name' => 'Боевик'],
            ['name' => 'Детектив'],
            ['name' => 'Роман'],
            ['name' => 'Фэнтези'],
            ['name' => 'Нехудожественная литература'],
        ]);

        \App\Models\Warehouse::query()->insert([
            [
                'country' => 'Россия',
                'region' => 'Санкт-Петербург',
                'city' => 'Санкт-Петербург',
                'street' => 'Суворовский',
                'house' => '22',
                'building' => '4',
                'flat' => '8',
            ],
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
