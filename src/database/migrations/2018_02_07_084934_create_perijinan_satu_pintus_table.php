<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePerijinanSatuPintusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
	public function up()
	{
		Schema::create('perijinan_satu_pintus', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('group_egovernment_id');
			$table->string('label')->nullable();
			$table->string('description')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
	}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
	public function down()
	{
		Schema::drop('perijinan_satu_pintus');
	}
}
