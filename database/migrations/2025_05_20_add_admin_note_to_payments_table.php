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
        Schema::table('payments', function (Blueprint $table) {
            if (!Schema::hasColumn('payments', 'admin_note')) {
                $table->text('admin_note')->nullable()->after('notes');
            }
            if (!Schema::hasColumn('payments', 'verified_by')) {
                $table->unsignedBigInteger('verified_by')->nullable()->after('verified_at');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            if (Schema::hasColumn('payments', 'admin_note')) {
                $table->dropColumn('admin_note');
            }
            if (Schema::hasColumn('payments', 'verified_by')) {
                $table->dropColumn('verified_by');
            }
        });
    }
}; 