<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
		$table->string('telefon')->after('email')->nullable($value = true);
		$table->string('company')->after('telefon')->nullable($value = true);
		$table->string('address')->after('company')->nullable($value = true);
		$table->string('city')->after('address')->nullable($value = true);
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
