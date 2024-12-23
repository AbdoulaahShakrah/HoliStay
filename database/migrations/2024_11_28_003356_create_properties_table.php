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
        Schema::create('properties', function (Blueprint $table) {
            $table->id('property_id');
            $table->unsignedBigInteger('host_id'); 
            $table->foreign('host_id')->references('host_id')->on('hosts')->onDelete('cascade');
            $table->string('property_name');
            $table->string('property_country');
            $table->string('property_city');
            $table->string('property_address');
            $table->string('property_type');
            $table->integer('property_bedrooms')->unsigned()->nullable();
            $table->integer('property_bathrooms')->unsigned()->nullable();
            $table->integer('property_beds')->unsigned()->nullable();
            $table->integer('cancellation_policy'); //por dias sem penalização não vamos entrar em precentagens de reembolso...
            $table->decimal('property_price');
            $table->string('property_status');
            $table->integer('property_capacity');
            $table->text('property_description'); // com vista a paria etc...
            $table->integer('page_visits')->default(0);
            $table->softDeletes();
            $table->timestamps();
       });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
