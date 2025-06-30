<?php

use App\Models\Category;
use App\Models\SubCategory;
use App\Models\UkState;
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
        Schema::create('pets', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(User::class);
            $table->foreignIdFor(Category::class);
            $table->foreignIdFor(SubCategory::class);
            $table->foreignIdFor(UkState::class);
            $table->string('advert_id');
            $table->string('thumbnail')->nullable();
            $table->string('name');
            $table->string('slug');
            $table->string('age')->nullable();
            $table->string('size')->nullable();
            $table->string('location')->nullable();
            $table->tinyText('map_link')->nullable();
            $table->tinyText('website_link')->nullable();
            $table->text('about')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->string('tag')->nullable();
            $table->enum('gender', ['male', 'female']);
            $table->decimal('price', 20, 2)->nullable();
            $table->decimal('price_from', 20, 2)->nullable();
            $table->decimal('price_to', 20, 2)->nullable();
            $table->text('description');
            $table->text('feature_list');
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_top_search')->default(false);
            $table->enum('status', ['available', 'sold', 'pending'])->default('available');
            $table->enum('gender', ['male', 'female', 'other'])->default('male');
            $table->enum('price_type', ['fixed', 'negotiable', 'on call'])->default('negotiable');
            $table->enum('ad_type', ['rehome', 'adopt'])->default('rehome');
            $table->unsignedBigInteger('likes')->default(0);
            $table->unsignedBigInteger('views')->default(0);
            $table->integer('health_guarantee')->nullable();
            $table->string('pet_insurance')->nullable();
            $table->tinyInteger('sdfas')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pets');
    }
};
