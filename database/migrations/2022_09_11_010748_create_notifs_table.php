<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotifsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifs', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->text('body');
            $table->string('title');
            $table->string('url')->nullable();
            $table->unsignedInteger('post_id')->nullable();
            $table->unsignedInteger('order_id')->nullable();
            $table->string('room_ids')->nullable();
            $table->unsignedInteger('earning_id')->nullable();
            $table->unsignedInteger('refund_id')->nullable();
            $table->timestamps();;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifs');
    }
}
