<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class SqlImportSeeder extends Seeder
{
    public function run(): void
    {
        $sqlFile = database_path('cs_scholarship.sql');

        if (!File::exists($sqlFile)) {
            $this->command->error("SQL file not found: {$sqlFile}");
            return;
        }

        $this->command->info('Starting SQL import from: ' . $sqlFile);

        $sql = File::get($sqlFile);

        // Remove SET statements and comments that might cause issues
        $sql = preg_replace('/^SET .+;$/m', '', $sql);
        $sql = preg_replace('/^-- .+$/m', '', $sql);
        $sql = preg_replace('/\/\*.*?\*\//s', '', $sql);

        // Split into statements and filter out empty ones
        $statements = array_filter(array_map('trim', explode(';', $sql)));

        $this->command->info('Found ' . count($statements) . ' SQL statements to execute');

        $successCount = 0;
        $errorCount = 0;

        foreach ($statements as $statement) {
            if (!empty($statement)) {
                try {
                    DB::statement($statement);
                    $successCount++;
                } catch (\Exception $e) {
                    $this->command->error("Error executing: " . substr($statement, 0, 100) . "...");
                    $this->command->error($e->getMessage());
                    $errorCount++;
                }
            }
        }

        $this->command->info("SQL import completed: {$successCount} successful, {$errorCount} errors");
    }
}
