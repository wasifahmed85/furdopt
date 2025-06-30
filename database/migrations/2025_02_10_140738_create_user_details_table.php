<?php

use App\Models\Country;
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
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->integer('age')->nullable();
            $table->unsignedTinyInteger('age_status')->default(1);
            $table->foreignIdFor(Country::class);
            $table->foreignIdFor(UkState::class)->nullable();
            $table->unsignedTinyInteger('country_status')->default(1);
            $table->string('city')->nullable();
            $table->unsignedTinyInteger('city_status')->default(1);
            $table->string('name')->nullable();
            $table->string('location')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('seeking')->nullable();
            $table->enum('married_status', ['single', 'married', 'widow', 'divorce', 'prefer not say'])->nullable();
            $table->string('education')->nullable();
            $table->string('specialist')->nullable();

            $table->mediumText('bio')->nullable();
            $table->enum('role', ['admin', 'owner'])->default('owner');
            $table->enum('gender', ['man', 'women', 'nonbinary'])->nullable();
            $table->date('dob')->nullable();
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->mediumText('language')->nullable();
            $table->mediumText('sports')->nullable();
            $table->string('children')->nullable();
            $table->string('religion')->nullable();
            $table->mediumText('hobies')->nullable();
            $table->string('looking_for')->nullable();
            $table->string('looking_for_age_from')->nullable();
            $table->string('looking_for_age_to')->nullable();
            $table->string('looking_for_weight_from')->nullable();
            $table->string('looking_for_weight_to')->nullable();
            $table->string('looking_for_height_from')->nullable();
            $table->string('looking_for_height_to')->nullable();
            $table->string('looking_for_religion')->nullable();
            $table->string('looking_for_married_status')->nullable();
            $table->string('looking_for_language')->nullable();
            $table->string('looking_for_education')->nullable();
            $table->string('looking_for_location')->nullable();
            $table->string('looking_for_state')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_details');
    }
};
