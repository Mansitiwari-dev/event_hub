<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

// Check database connection
try {
    DB::connection()->getPdo();
    echo "Database connection successful!\n";
} catch (\Exception $e) {
    die("Could not connect to the database. Please check your configuration. Error: " . $e->getMessage() . "\n");
}

// Check if roles table exists
$tables = DB::select('SHOW TABLES');
echo "Tables in database:\n";
foreach ($tables as $table) {
    print_r($table);
}

// Try to insert a role
try {
    $id = DB::table('roles')->insertGetId([
        'name' => 'admin',
        'display_name' => 'Administrator',
        'description' => 'System Administrator',
        'created_at' => now(),
        'updated_at' => now()
    ]);
    echo "\nInserted role with ID: $id\n";
} catch (\Exception $e) {
    echo "\nError inserting role: " . $e->getMessage() . "\n";
    
    // Try to create the roles table
    try {
        echo "\nAttempting to create roles table...\n";
        DB::statement('
            CREATE TABLE IF NOT EXISTS roles (
                id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255) NOT NULL,
                display_name VARCHAR(255) NULL,
                description TEXT NULL,
                created_at TIMESTAMP NULL,
                updated_at TIMESTAMP NULL,
                UNIQUE KEY roles_name_unique (name)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        ');
        echo "Roles table created successfully!\n";
    } catch (\Exception $e) {
        echo "Error creating roles table: " . $e->getMessage() . "\n";
    }
}