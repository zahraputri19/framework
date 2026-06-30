<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('books', function (Blueprint $table) {
            if (!Schema::hasColumn('books', 'available_stock')) {
                $table->integer('available_stock')->default(0);
            }
            if (!Schema::hasColumn('books', 'is_under_repair')) {
                $table->boolean('is_under_repair')->default(false);
            }
            if (!Schema::hasColumn('books', 'repair_status')) {
                $table->string('repair_status')->nullable();
            }
        });

        Schema::table('email_otps', function (Blueprint $table) {
            if (!Schema::hasColumn('email_otps', 'is_verified')) {
                $table->boolean('is_verified')->default(false);
            }
        });
    }

    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropColumn(['available_stock', 'is_under_repair', 'repair_status']);
        });

        Schema::table('email_otps', function (Blueprint $table) {
            $table->dropColumn('is_verified');
        });
    }
};
