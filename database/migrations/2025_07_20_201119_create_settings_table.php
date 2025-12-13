<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSettingsTable extends Migration {

	public function up()
	{
		Schema::create('settings', function(Blueprint $table) {
			$table->increments('id');
			$table->string('phone');
			$table->string('email');
			$table->string('fb_url');
			$table->string('x_url');
			$table->string('app_store_url');
			$table->string('about_app');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('settings');
	}
}