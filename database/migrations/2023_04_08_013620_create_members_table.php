<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string("nickname", 255);
            $table->string("email", 128);
            $table->string("password", 64);
            $table->string("api_token", 80)->nullable()->default(null)->comment("トークン");
            $table->tinyInteger("status")->comment("0:仮登録 1:通常 2:退会");
            $table->integer("points")->default(0)->comment("ポイント");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
}
