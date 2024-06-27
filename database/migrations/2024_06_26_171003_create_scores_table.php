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
        Schema::create('scores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('alternative_id');
            $table->unsignedBigInteger('subkriteria_id');
            $table->decimal('value', 8, 2);
            $table->timestamps();

            // Foreign keys
            $table->foreign('alternative_id')->references('id')->on('alternatifs')->onDelete('cascade');
            $table->foreign('subkriteria_id')->references('id')->on('sub_kriterias')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scores');
    }
};
