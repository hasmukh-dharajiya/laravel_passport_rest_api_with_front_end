<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->string('location')->nullable();
            $table->string('mobile')->nullable();
            $table->string('profile_pic')->nullable();
            $table->string('gender')->nullable();
            $table->string('email_follow_me')->nullable();
            $table->string('email_answers_my_post')->nullable();
            $table->string('email_someone_mentions_me')->nullable();
            $table->string('new_launches_projects')->nullable();
            $table->string('monthly_product_updates')->nullable();
            $table->string('subscribe_to_newsletter')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('active')->default(1);
            $table->string('confirmation_code')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('last_login_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
