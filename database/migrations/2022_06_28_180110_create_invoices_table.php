<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->integer('number')->unique();
            $table->date('invoice_date')->nullable();
            $table->unsignedTinyInteger('status')->default(0);
            $table->decimal('reservation_value',8,2)->nullable();;
            $table->decimal('amount_commission',8,2);
            $table->decimal('total',8,2);
            $table->decimal('discount',8,2)->nullable();;
            $table->text('note')->nullable();
            $table->date('due_date')->nullable();
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->unsignedBigInteger('reservation_id');
            $table->foreign('reservation_id')->references('id')->on('reservations')->onDelete('cascade');

            $table->unsignedBigInteger('payment_id');
            $table->foreign('payment_id')->references('id')->on('payment_wallets')->onDelete('cascade');

            $table->softDeletes();

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
        Schema::dropIfExists('invoices');
    }
}
