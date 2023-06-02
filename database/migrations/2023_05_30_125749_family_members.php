<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FamilyMembers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('family_members', function (Blueprint $table) {
            $table->id();
            $table->string('fullname')->nullable()->default(null);
            $table->string('role_name')->nullable()->default(null);
            $table->string('avatar')->nullable()->default(null);
            $table->date('birthday')->nullable()->default(null);
            $table->date('leaveday')->nullable()->default(null);
            $table->string('address')->nullable()->default(null);
            $table->string('phone')->nullable()->default(null);
            $table->string('email')->nullable()->default(null);
            $table->tinyInteger('gender')->nullable()->default(null)->comment('1: male, 2: female');
            $table->longText('story')->nullable()->default(null);
            $table->integer('position_index')->nullable()->default(null);
            $table->string('pids')->nullable()->default(null)->comment('id of relation couple');
            $table->bigInteger('mid')->nullable()->default(null)->comment('mother id');
            $table->bigInteger('fid')->nullable()->default(null)->comment('father id');
            $table->bigInteger('user_id')->nullable()->default(null)->comment('created by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('family_members');
    }
}
