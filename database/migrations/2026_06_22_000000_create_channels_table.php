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
        Schema::create('channels', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('logo_url')->nullable();
            $table->text('stream_url');
            $table->string('group')->nullable();
            $table->string('type')->default('hls'); // 'hls' or 'dash'
            $table->string('drm_kid')->nullable(); // ClearKey DRM Key ID
            $table->string('drm_key')->nullable(); // ClearKey DRM Content Key
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('channels');
    }
};
