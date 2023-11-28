<?php

use Carbon\Carbon;
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
        Schema::create('gardens', function (Blueprint $table) {
            $table->id();
            $table->double('lat');
            $table->double('lng');
            $table->string('name');
            $table->text('description');
            // $table->foreignId('main_picture_id')->nullable()->references('id')->on('garden_images');
            $table->string('contact_phone');
            $table->string('contact_email');
            $table->boolean('running');
            $table->timestamp('opening_time')->nullable();
            $table->timestamp('closing_time')->nullable();
            $table->foreignId('owner_id')->references('id')->on('users');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gardens');
    }
};
