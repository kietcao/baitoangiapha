<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCccdToMember extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('family_members', function (Blueprint $table) {
            $table->string('cccd_number')->nullable()->default(null)->after('avatar');
            $table->string('cccd_image_before')->nullable()->default(null)->after('avatar');
            $table->string('cccd_image_after')->nullable()->default(null)->after('avatar');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('family_members', function (Blueprint $table) {
            $table->dropColumn('cccd_number');
            $table->dropColumn('cccd_image_before');
            $table->dropColumn('cccd_image_after');
        });
    }
}
