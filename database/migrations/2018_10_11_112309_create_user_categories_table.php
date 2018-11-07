<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_categories', function (Blueprint $table) {
            $table->increments('id');
			$table->unsignedInteger('user_id');
			$table->unsignedInteger('demand_category_id');
			$table->unsignedInteger('offer_category_id');
            $table->timestamps();
			$table->foreign('user_id')->references('id')->on('users');
			$table->foreign('demand_category_id')->references('id')->on('categories');
			$table->foreign('offer_category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_categories');
    }
}
