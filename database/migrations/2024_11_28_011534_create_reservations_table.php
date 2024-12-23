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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id('reservation_id');
            $table->unsignedBigInteger('property_id'); 
            $table->foreign('property_id')->references('property_id')->on('properties')->onDelete('cascade');
            $table->unsignedBigInteger('client_id'); 
            $table->foreign('client_id')->references('client_id')->on('clients')->onDelete('cascade');
            $table->dateTime('check_in_date');
            $table->dateTime('check_out_date');
            $table->string('reservation_status')->default("Pending");
            $table->decimal('reservation_amount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
