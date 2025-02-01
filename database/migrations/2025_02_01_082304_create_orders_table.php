<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->date('application_date')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('phone')->nullable();
            $table->unsignedBigInteger("source_id")->nullable();
            $table->unsignedBigInteger('call_status_id')->nullable();
            $table->unsignedBigInteger('order_status_id')->nullable();
            $table->date('call_date')->nullable();
            $table->text('request')->nullable();
            $table->text('price_offer')->nullable();
            $table->text('note')->nullable();
            $table->foreign('call_status_id')->references('id')->on('call_statuses')->onDelete('set null');
            $table->foreign('order_status_id')->references('id')->on('order_statuses')->onDelete('set null');
            $table->foreign('source_id')->references('id')->on('sources')->onDelete('set null');
            $table->tinyInteger("status")->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
