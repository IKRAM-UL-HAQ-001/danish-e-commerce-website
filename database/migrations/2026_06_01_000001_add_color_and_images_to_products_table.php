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
        Schema::table('products', function (Blueprint $table) {
            if (!Schema::hasColumn('products', 'image_mobile')) {
                $table->string('image_mobile')->nullable()->after('image');
            }
            if (!Schema::hasColumn('products', 'image_laptop')) {
                $table->string('image_laptop')->nullable()->after('image_mobile');
            }
            if (!Schema::hasColumn('products', 'color_name')) {
                $table->string('color_name')->nullable()->after('image_laptop');
            }
            if (!Schema::hasColumn('products', 'color_hex')) {
                $table->string('color_hex', 7)->nullable()->after('color_name');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            if (Schema::hasColumn('products', 'color_hex')) {
                $table->dropColumn('color_hex');
            }
            if (Schema::hasColumn('products', 'color_name')) {
                $table->dropColumn('color_name');
            }
            if (Schema::hasColumn('products', 'image_laptop')) {
                $table->dropColumn('image_laptop');
            }
            if (Schema::hasColumn('products', 'image_mobile')) {
                $table->dropColumn('image_mobile');
            }
        });
    }
};
