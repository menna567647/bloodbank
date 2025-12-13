<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientsTable extends Migration
{

	public function up()
	{
		Schema::create('clients', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name', 255)->default('none');
			$table->string('phone', 255)->default('null');
			$table->string('password', 255);
			$table->string('email', 255);
			$table->date('dob');
			$table->integer('blood_type_id')->unsigned();
			$table->date('last_donation_date');
			$table->integer('city_id')->unsigned();
			$table->enum('status', ['active', 'blocked'])->default('active');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('clients');
	}
}
