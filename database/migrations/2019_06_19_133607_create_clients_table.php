<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientsTable extends Migration {

	public function up()
	{
		Schema::create('clients', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name');
			$table->text('email');
			$table->date('birthday');
			$table->integer('blood_type_id');
			$table->date('last_donate');
			$table->integer('city_id');
			$table->integer('mobile');
			$table->string('password');
			$table->boolean('banned');
			$table->integer('pin');
			$table->string('api_token', 60)->unique()->nullable();
		});
	}

	public function down()
	{
		Schema::drop('clients');
	}
}