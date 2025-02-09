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
        Schema::create('c_sections', function (Blueprint $table) {
            $table->id();
            $table->integer('order');
            $table->string('code', 100);
            $table->string('name', 100);
            $table->softDeletes();
            $table->timestamps();

            $table->unique('code', 'UNIQ_c_category_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('c_sections');
    }
};
