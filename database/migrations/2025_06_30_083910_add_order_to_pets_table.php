<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('pets', function (Blueprint $table) {
            $table->boolean('is_featured')->default(0)->after('featured_list');
            $table->unsignedBigInteger('position')->default(0)->after('is_featured');
        });
    }

    public function down(): void
    {
        Schema::table('pets', function (Blueprint $table) {
            $table->dropColumn('is_featured');
            $table->dropColumn('position');
        });
    }
};
