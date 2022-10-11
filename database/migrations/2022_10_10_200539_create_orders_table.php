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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number');
            $table->enum('type',['dine-in','delivery','takeaway']);
            $table->string('customer_name')->nullable();
            $table->string('customer_phone')->nullable();
            $table->integer('delivery_fees')->nullable();
            $table->tinyInteger('table_number')->nullable();
            $table->tinyInteger('service_charge')->nullable();
            $table->string('waiter_name',100)->nullable();
            $table->decimal('total_price');
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
        Schema::dropIfExists('orders');
    }
};
