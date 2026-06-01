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
        Schema::table('categories', function (Blueprint $table) {
            if (!Schema::hasColumn('categories', 'image_mobile')) {
                $table->string('image_mobile')->nullable()->after('image');
            }
            if (!Schema::hasColumn('categories', 'image_laptop')) {
                $table->string('image_laptop')->nullable()->after('image_mobile');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            if (Schema::hasColumn('categories', 'image_laptop')) {
                $table->dropColumn('image_laptop');
            }
            if (Schema::hasColumn('categories', 'image_mobile')) {
                $table->dropColumn('image_mobile');
            }
        });
    }
};
