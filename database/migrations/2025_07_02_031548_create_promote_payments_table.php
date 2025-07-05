<?php

use App\Models\Pet;
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
        Schema::create('promote_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(Pet::class);
            $table->string('payment_gateway'); // 'paypal' or 'stripe'
            $table->string('transaction_id')->unique();
            $table->decimal('amount', 10, 2);
            $table->string('status'); // 'pending', 'completed', 'failed'
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promote_payments');
    }
};
