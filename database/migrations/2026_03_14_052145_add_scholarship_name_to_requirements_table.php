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
    Schema::table('requirements', function (Blueprint $table) {
        $table->string('scholarship_name')->after('scholastic_record');
        $table->string('sponsor')->after('scholarship_name');
        $table->string('year_level')->after('sponsor');
        $table->decimal('gpa', 3, 2)->after('year_level');
        $table->longText('plan')->after('gpa');
        $table->string('status')->default('pending')->after('plan');
    });
}

public function down(): void
{
    Schema::table('requirements', function (Blueprint $table) {
        $table->dropColumn([
            'scholarship_name',
            'sponsor',
            'year_level',
            'gpa',
            'plan',
            'status'
        ]);
    });
}
};
