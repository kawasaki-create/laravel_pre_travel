<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // 登録OSと最終ログインOS、日時、Vipユーザーフラグを追加
            $table->integer('register_os')->default(9)->comment('会員登録OS(web：0、iOS：1、Android：2、初期値：9)');
            $table->integer('last_login_os')->default(9)->comment('最終ログインOS(web：0、iOS：1、Android：2)、初期値：9');
            $table->dateTime('last_login_at')->nullable()->comment('最終ログイン日時');
            $table->boolean('vip_flg')->default(false)->comment('VIPユーザーフラグ(true：VIPユーザー、false：一般ユーザー)');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // 登録OSと最終ログインOS、日時を削除
            $table->dropColumn('register_os');
            $table->dropColumn('last_login_os');
            $table->dropColumn('last_login_at');
            $table->dropColumn('vip_flg');
        });
    }
};
