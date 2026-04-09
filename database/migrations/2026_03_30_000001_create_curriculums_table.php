<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('curriculums', function (Blueprint $table) {
            $table->id();
            $table->string('department');
            $table->string('semester');
            $table->string('course_title');
            $table->timestamps();

            $table->index(['department', 'semester']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('curriculums');
    }
};
