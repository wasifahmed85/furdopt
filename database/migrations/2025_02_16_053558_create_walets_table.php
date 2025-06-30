<?php

use App\Models\User;
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
        Schema::create('walets', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->decimal('amount', 20, 2);
            $table->string('last_transaction_id');
            $table->enum('last_transaction_type', ['add', 'deduct']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('walets');
    }
};
