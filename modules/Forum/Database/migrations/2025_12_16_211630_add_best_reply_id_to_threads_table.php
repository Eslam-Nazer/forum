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
        Schema::table('threads', static function (Blueprint $table) {
            $table->unsignedBigInteger('best_reply_id')->nullable()->default(null)->after('channel_id');

            $table->foreign('best_reply_id')->references('id')->on('replies')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('threads', static function (Blueprint $table) {
            $table->dropForeign('threads_best_reply_id_foreign');
            $table->dropColumn('best_reply_id');
        });
    }
};
