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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->integer("amount")->default(0)->comment("購入金額");
            $table->integer("points")->default(0)->comment("付与ポイント");
            $table->dateTime('started_at')->nullable()->comment('掲載開始日時');
            $table->dateTime('ended_at')->nullable()->comment('掲載終了日時');
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
        Schema::dropIfExists('payments');
    }
};
