<?php

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
        Schema::table('gardens', function (Blueprint $table) {

            Schema::table('gardens', function (Blueprint $table) {

                $table->dropColumn('running');
            });

            Schema::table('gardens', function (Blueprint $table) {

                $table->boolean('running')->default(0);
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('gardens', function (Blueprint $table) {

            $table->dropColumn('running');
        });

        Schema::table('gardens', function (Blueprint $table) {

            $table->boolean('running');
        });
    }
};
