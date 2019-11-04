<?php

use App\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddApiUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        User::create([
            'login' => 'api.1c.erp',
            'name' => 'api.1c.erp',
            'email' => '1c.erp@sa3.ru',
            'password' => 'df3Nrhlx7dRt'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('
        DELETE FROM users;
        ');
    }
}
