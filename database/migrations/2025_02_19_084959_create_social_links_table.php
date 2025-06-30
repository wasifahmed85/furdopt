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
        Schema::create('social_links', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->string('facebook')->nullable();
            $table->tinyInteger('facebook_verify')->default(0);
            $table->string('instagram')->nullable();
            $table->tinyInteger('instagram_verify')->default(0);
            $table->string('youtube')->nullable();
            $table->tinyInteger('youtube_verify')->default(0);
            $table->string('tiktok')->nullable();
            $table->tinyInteger('tiktok_verify')->default(0);
            $table->string('snapchat')->nullable();
            $table->tinyInteger('snapchat_verify')->default(0);
            $table->string('whatsapp')->nullable();
            $table->tinyInteger('whatsapp_verify')->default(0);
            $table->string('telegram')->nullable();
            $table->tinyInteger('telegram_verify')->default(0);
            $table->string('google')->nullable();
            $table->tinyInteger('google_verify')->default(0);
            $table->string('twitter')->nullable();
            $table->tinyInteger('twitter_verify')->default(0);
            $table->string('linkedin')->nullable();
            $table->tinyInteger('linkedin_verify')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('social_links');
    }
};
