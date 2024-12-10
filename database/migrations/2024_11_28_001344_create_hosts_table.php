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
        Schema::create('hosts', function (Blueprint $table) {
            $table->id('host_id');
            $table->integer('user_id')->unsigned(); 
            $table->text('host_description');
            $table->string('job');
            $table->string('iban', 34)->nullable();
            $table->string('nif')->nullable();
            $table->tinyInteger('rate')->nullable();
            $table->boolean('verification_status')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hosts');
    }
};
