<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->string('scholarship_name')->nullable();
            $table->string('sponsor')->nullable();
            $table->decimal('gpa', 3, 2)->nullable();
            $table->longText('plan')->nullable();
            $table->string('scholastic_record')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->dropColumn('scholarship_name');
            $table->dropColumn('sponsor');
            $table->dropColumn('gpa');
            $table->dropColumn('plan');
            $table->dropColumn('scholastic_record');
        });
    }
};
