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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->text('logo');
            $table->text('favicon');
            $table->string('top_bar_phone')->nullable();
            $table->string('top_bar_email')->nullable();
            $table->string('footer_phone');
            $table->string('footer_email');
            $table->text('footer_address');
            $table->string('footer_facebook')->nullable();
            $table->string('footer_instagram')->nullable();
            $table->string('footer_twitter')->nullable();
            $table->string('footer_linkedin')->nullable();
            $table->text('footer_copyright_text');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
