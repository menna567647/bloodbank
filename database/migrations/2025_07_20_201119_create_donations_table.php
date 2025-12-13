<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDonationsTable extends Migration
{

	public function up()
	{
		Schema::create('donations', function (Blueprint $table) {
			$table->increments('id');
			$table->string('patient_name');
			$table->integer('patient_age');
			$table->string('patient_phone');
			$table->integer('blood_type_id')->unsigned();
			$table->integer('number_of_bags');
			$table->integer('city_id')->unsigned();
			$table->string('hospital_name')->nullable();
			$table->text('notes')->nullable();
			$table->unsignedInteger('client_id');
			$table->enum('status', ['pending', 'fulfilled', 'expired'])->default('pending');
			$table->boolean('is_spam')->default(false);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('donations');
	}
}
