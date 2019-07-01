<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSettingsTable extends Migration {

	public function up()
	{
		Schema::create('settings', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('logo');
			$table->string('title');
			$table->integer('mobile');
			$table->string('email');
			$table->string('facebook');
			$table->string('twitter');
			$table->string('gmail');
			$table->string('instagram');
			$table->string('youtube');
			$table->string('whatsapp');
			$table->text('about');
			$table->string('app_url');
			$table->string('android_url');
		});
	}

	public function down()
	{
		Schema::drop('settings');
	}
}