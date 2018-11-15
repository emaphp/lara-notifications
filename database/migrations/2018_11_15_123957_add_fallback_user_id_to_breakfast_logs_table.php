<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFallbackUserIdToBreakfastLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('breakfast_logs', function (Blueprint $table) {
            $table->unsignedInteger('fallback_user_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('breakfast_logs', function (Blueprint $table) {
            $table->dropColumn('fallback_user_id');
        });
    }
}
