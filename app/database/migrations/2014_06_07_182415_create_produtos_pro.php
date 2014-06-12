<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdutosPro extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('produtos_pro', function(Blueprint $table)
		{
			$table->increments('id_pro');
			$table->integer('id_ptp_pro');
			$table->string('nome_pro');
			$table->string('descricao_pro', 500);
			//$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('produtos_pro');
	}

}
