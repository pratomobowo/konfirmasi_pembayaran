<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;

class ExportSqlCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:export-sql {output=database/export.sql : Path to output SQL file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Export database to SQL format compatible with MySQL';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $output = $this->argument('output');
        
        $this->info('Starting export of SQLite database to MySQL compatible SQL...');
        
        $tables = DB::select("SELECT name FROM sqlite_master WHERE type='table' AND name NOT LIKE 'sqlite_%'");
        
        $sqlContent = "-- SQLite to MySQL export generated on " . date('Y-m-d H:i:s') . "\n";
        $sqlContent .= "-- This file contains CREATE TABLE statements and INSERT data\n\n";
        $sqlContent .= "SET FOREIGN_KEY_CHECKS=0;\n\n";
        
        foreach ($tables as $table) {
            $tableName = $table->name;
            
            // Skip migrations tables as they will be recreated by Laravel
            if ($tableName === 'migrations') {
                continue;
            }
            
            $this->info("Processing table: {$tableName}");
            
            // Get the table structure
            $columns = DB::select("PRAGMA table_info({$tableName})");
            
            // Create table SQL
            $sqlContent .= "DROP TABLE IF EXISTS `{$tableName}`;\n";
            $sqlContent .= "CREATE TABLE `{$tableName}` (\n";
            
            $columnDefs = [];
            $primaryKey = null;
            
            foreach ($columns as $column) {
                $type = $this->mapSqliteTypeToMysql($column->type);
                $nullable = $column->notnull ? ' NOT NULL' : ' NULL';
                $default = $column->dflt_value !== null 
                    ? ' DEFAULT ' . $this->formatDefaultValue($column->dflt_value, $type) 
                    : '';
                
                $columnDef = "  `{$column->name}` {$type}{$nullable}{$default}";
                $columnDefs[] = $columnDef;
                
                if ($column->pk) {
                    $primaryKey = $column->name;
                }
            }
            
            // Add timestamps if they exist
            if (Schema::hasColumn($tableName, 'created_at') && Schema::hasColumn($tableName, 'updated_at')) {
                // Already included in the columns
            }
            
            // Add primary key if exists
            if ($primaryKey) {
                $columnDefs[] = "  PRIMARY KEY (`{$primaryKey}`)";
            }
            
            $sqlContent .= implode(",\n", $columnDefs);
            $sqlContent .= "\n) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;\n\n";
            
            // Get table data
            $rows = DB::table($tableName)->get();
            
            if (count($rows) > 0) {
                // Generate insert statements
                $chunks = $rows->chunk(100); // Process 100 rows at a time to avoid memory issues
                
                foreach ($chunks as $chunk) {
                    $insertHeader = "INSERT INTO `{$tableName}` (";
                    $insertHeader .= implode(', ', array_map(function ($column) {
                        return "`{$column->name}`";
                    }, $columns));
                    $insertHeader .= ") VALUES\n";
                    
                    $valueLines = [];
                    foreach ($chunk as $row) {
                        $values = [];
                        foreach ($columns as $column) {
                            $value = $row->{$column->name};
                            if ($value === null) {
                                $values[] = 'NULL';
                            } elseif (in_array(strtolower($column->type), ['integer', 'real', 'float', 'double', 'numeric'])) {
                                $values[] = $value;
                            } else {
                                $escapedValue = str_replace("'", "''", $value);
                                $values[] = "'{$escapedValue}'";
                            }
                        }
                        $valueLines[] = "(" . implode(', ', $values) . ")";
                    }
                    
                    if (!empty($valueLines)) {
                        $sqlContent .= $insertHeader . implode(",\n", $valueLines) . ";\n\n";
                    }
                }
            }
        }
        
        $sqlContent .= "SET FOREIGN_KEY_CHECKS=1;\n";
        
        // Write to file
        File::put($output, $sqlContent);
        
        $this->info("Export completed! SQL file saved to: {$output}");
        $this->line("You can now import this file into your MySQL database");
        
        return Command::SUCCESS;
    }
    
    /**
     * Map SQLite data types to MySQL equivalents
     */
    private function mapSqliteTypeToMysql($type)
    {
        $type = strtolower($type);
        
        switch ($type) {
            case 'integer':
                return 'int(11)';
            case 'real':
            case 'double':
            case 'float':
                return 'double';
            case 'numeric':
                return 'decimal(10,2)';
            case 'boolean':
            case 'bool':
                return 'tinyint(1)';
            case 'timestamp':
            case 'datetime':
                return 'datetime';
            case 'date':
                return 'date';
            case 'time':
                return 'time';
            case 'varchar':
                return 'varchar(255)';
            case 'blob':
                return 'blob';
            case 'text':
            default:
                return 'text';
        }
    }
    
    /**
     * Format default value for MySQL
     */
    private function formatDefaultValue($value, $type)
    {
        if ($value === 'NULL') {
            return 'NULL';
        }
        
        if (in_array($type, ['int(11)', 'double', 'decimal(10,2)', 'tinyint(1)'])) {
            return $value;
        }
        
        // Remove quotes if string starts and ends with them
        if (strlen($value) >= 2 && $value[0] === "'" && $value[strlen($value) - 1] === "'") {
            $value = substr($value, 1, -1);
        }
        
        // Special handling for CURRENT_TIMESTAMP
        if ($value === 'CURRENT_TIMESTAMP') {
            return 'CURRENT_TIMESTAMP';
        }
        
        return "'{$value}'";
    }
} 