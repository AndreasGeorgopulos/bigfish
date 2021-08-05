<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserPhonesTable extends Migration
{
    const TABLE_USERS = 'users';
    const TABLE_USER_PHONES = 'user_phones';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE_USER_PHONES, function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->string('phone_number', 30);
            $table->boolean('is_default')->default(false);
            $table->timestamps();

            $table->index(['user_id', 'phone_number']);
            $table->foreign('user_id')->on(self::TABLE_USERS)->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(self::TABLE_USER_PHONES);
    }
}
