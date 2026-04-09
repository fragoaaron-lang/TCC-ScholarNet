<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('announcements', function (Blueprint $table) {
            // Add targeting columns if they don't exist
            if (!Schema::hasColumn('announcements', 'audience_type')) {
                $table->enum('audience_type', ['all_students', 'secretaries', 'department', 'personal'])->default('all_students')->after('content');
            }
            if (!Schema::hasColumn('announcements', 'target_department')) {
                $table->string('target_department')->nullable()->after('audience_type');
            }
            if (!Schema::hasColumn('announcements', 'admin_id')) {
                $table->foreignId('admin_id')->nullable()->constrained('admins')->onDelete('cascade')->after('user_id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('announcements', function (Blueprint $table) {
            $table->dropColumn(['audience_type', 'target_department']);
            if (Schema::hasColumn('announcements', 'admin_id')) {
                $table->dropForeign(['admin_id']);
                $table->dropColumn('admin_id');
            }
        });
    }
};
