<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

//As migrations funcionam como um versionamento de BD
//Elas permitem avançar e retroceder (rollback) a qualquer momento o estado do DB

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations (quando avança o estado do BD, este comando cria a tabela)
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("title");
            $table->text("description");
            $table->string("city");
            $table->boolean("private");
        });
    }

    /**
     * Reverse the migrations (quando retrocede (rollback) o estado do BD, este comando deleta a tabela)
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
