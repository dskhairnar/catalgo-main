<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Drop tables in reverse order of dependencies
        Schema::dropIfExists('saved_services');
        Schema::dropIfExists('personal_access_tokens');
        Schema::dropIfExists('reviews');
        Schema::dropIfExists('bookings');
        Schema::dropIfExists('activities');
        Schema::dropIfExists('saved_listings');
        Schema::dropIfExists('services');
        Schema::dropIfExists('listings');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('businesses');
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('jobs');
        Schema::dropIfExists('cache');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('users');
    }

    public function down()
    {
        // No need to recreate tables in down() as they will be recreated by other migrations
    }
}; 