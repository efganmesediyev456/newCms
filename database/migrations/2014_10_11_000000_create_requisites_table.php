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
        Schema::create('requisites', function (Blueprint $table) {
            $table->id();
            $table->string('voen');
            $table->string('legal_address');
            $table->string('actual_address');
            $table->string('bank');
            $table->string('bank_voen');
            $table->string('code');
            $table->string('settlement_account');
            $table->string('correspondent_account');
            $table->string('swift');
            $table->string('director');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requisites');
    }
};
