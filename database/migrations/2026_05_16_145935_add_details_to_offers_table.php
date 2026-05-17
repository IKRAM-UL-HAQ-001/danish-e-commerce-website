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
        Schema::table('offers', function (Blueprint $table) {
            $table->string('title')->after('id');
            $table->decimal('price', 10, 2)->after('description');
            $table->decimal('old_price', 10, 2)->nullable()->after('price');
            $table->unsignedBigInteger('product_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('offers', function (Blueprint $table) {
            $table->dropColumn(['title', 'price', 'old_price']);
            $table->unsignedBigInteger('product_id')->nullable(false)->change();
        });
    }
};
