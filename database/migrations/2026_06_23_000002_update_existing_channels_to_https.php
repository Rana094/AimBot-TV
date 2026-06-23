<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable('channels')) {
            DB::table('channels')
                ->where('stream_url', 'like', 'http://%')
                ->update([
                    'stream_url' => DB::raw("REPLACE(stream_url, 'http://', 'https://')")
                ]);

            DB::table('channels')
                ->where('logo_url', 'like', 'http://%')
                ->update([
                    'logo_url' => DB::raw("REPLACE(logo_url, 'http://', 'https://')")
                ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
