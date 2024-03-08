<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('business_abn')->nullable();
            $table->string('license_number')->nullable();
            $table->string('business_name')->nullable();
            $table->longText('business_details')->nullable();
            $table->string('stripe_customer_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('address_id');
            $table->double('balance')->nullable();
            $table->date('balance_updated_at')->nullable();
            $table->boolean('is_balance_auto_renew')->default(false);
            $table->boolean('stars')->default(5);
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
        Schema::dropIfExists('employees');
    }
}
