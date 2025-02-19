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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->integer("voen")->nullable();
            $table->string("fin_code")->nullable();
            $table->string("company_name")->nullable();
            $table->string("domen_names")->nullable();
            $table->string("director")->nullable();
            $table->string("customer_phone")->nullable();
            $table->string("responsible_persons")->nullable();
            $table->tinyInteger("customer_type")->default(0);
            $table->tinyInteger("status")->default(1);
            $table->unsignedBigInteger("customer_source_id")->nullable();
            $table->foreign("customer_source_id")->references('id')->on('customer_sources')->onDelete('set null');
            $table->unsignedBigInteger('requisite_id')->nullable();
            $table->foreign('requisite_id')->references('id')->on('requisites')->onDelete('set null');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
