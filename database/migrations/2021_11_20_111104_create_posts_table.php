<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->text('note')->nullable();
            $table->unsignedBigInteger('employee_id');//id of who posted
            $table->unsignedBigInteger('address_id');
            $table->unsignedBigInteger('service_id');
            $table->unsignedBigInteger('number_of_accepted')->default(0);
            $table->boolean('is_acceptable')->default(true);
            $table->string('status')->default('active');
            $table->string('close_reason')->nullable();
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
        Schema::dropIfExists('posts');
    }
}
