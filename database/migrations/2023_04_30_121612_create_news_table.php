<?php

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
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('title',128)->comment('タイトル');
            $table->string('description', 255)->comment('説明');
            $table->string('image')->nullable()->comment('画像');
            $table->dateTime('started_at')->comment('掲載開始日時');
            $table->dateTime('ended_at')->comment('掲載終了日時');
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
        Schema::dropIfExists('news');
    }
};
