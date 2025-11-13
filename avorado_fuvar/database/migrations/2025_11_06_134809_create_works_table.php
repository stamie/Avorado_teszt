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
        Schema::create('works', function (Blueprint $table) {
            $table->id();
            $table->longText('start_place');
            $table->longText('end_place');
            $table->string('recipient_name', 250);
            $table->string('recipient_phone', 20);
            $table->foreignId('status')->nullable(true)->constrained('statuses');            
            $table->foreignId('carrier')->nullable(true)->constrained('users');
            $table->timestamps();
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('works');
    }
};
