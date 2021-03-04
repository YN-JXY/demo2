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
            //创建一个integer类型的自增长id
            $table->increments('id');
            //string类型的name字段
            $table->string('name');
            //string类型的email字段，unique加上之后代表该字段的值是唯一的
            $table->string('email')->unique();
            //email验证时间，空的话意味着用户还未验证邮箱,nullable
            $table->timestamp('email_verified_at')->nullable();
            //创建一个String类型的password字段，字段最大类型为60,
            $table->string('password',60);
            
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
