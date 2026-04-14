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
        Schema::table('users', function (Blueprint $table) {
            $table->string('slug')->nullable()->unique()->after('name');
        });
        Schema::table('sliders', function (Blueprint $table) {
            $table->string('slug')->nullable()->unique()->after('title');
        });
        Schema::table('faqs', function (Blueprint $table) {
            $table->string('slug')->nullable()->unique()->after('question');
        });
        Schema::table('contact_messages', function (Blueprint $table) {
            $table->string('slug')->nullable()->unique()->after('id');
        });
        Schema::table('orders', function (Blueprint $table) {
            $table->string('order_number')->nullable()->unique()->after('id');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) { $table->dropColumn('slug'); });
        Schema::table('sliders', function (Blueprint $table) { $table->dropColumn('slug'); });
        Schema::table('faqs', function (Blueprint $table) { $table->dropColumn('slug'); });
        Schema::table('contact_messages', function (Blueprint $table) { $table->dropColumn('slug'); });
        Schema::table('orders', function (Blueprint $table) { $table->dropColumn('order_number'); });
    }
};
