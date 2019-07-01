<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration {

	public function up()
	{
		Schema::create('orders', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name');
			$table->integer('age');
			$table->integer('blood_type_id');
			$table->integer('num_quantity');
			$table->string('hospital');
			$table->string('address');
			$table->integer('mobile');
			$table->text('details');
			$table->decimal('latitude', 10,8);
			$table->decimal('longitude', 10,8);
			$table->integer('client_id');
			$table->integer('city_id');
		});
	}

	public function down()
	{
		Schema::drop('orders');
	}
}