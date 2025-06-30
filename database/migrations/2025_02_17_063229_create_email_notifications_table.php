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
        Schema::create('email_notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->tinyInteger('verification_status')->default(0);
            $table->tinyInteger('new_message_status')->default(0);
            $table->tinyInteger('new_visitor_status')->default(0);
            $table->tinyInteger('like_status')->default(0);
            $table->tinyInteger('match_status')->default(0);
            $table->tinyInteger('promotion_status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('email_notifications');
    }
};
