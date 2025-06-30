<?php

use App\Models\User;
use App\Models\Walet;
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
        Schema::create('walet_details', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Walet::class);
            $table->foreignIdFor(User::class);
            $table->decimal('amount', 20, 2);
            $table->string('transaction_id');
            $table->enum('transaction_type', ['add', 'deduct']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('walet_details');
    }
};
