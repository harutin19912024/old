<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDealParticipatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deal_participants', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('deal_id')->unsigned();
            $table->integer('deal_parties_id')->unsigned();
            $table->timestamps();
            
            $table->foreign('deal_id')->references('id')->on('deals')->onUpdate('cascade')->OnDelete('restrict');
            $table->foreign('deal_parties_id')->references('id')->on('deal_parties')->onUpdate('cascade')->OnDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deal_participates');
    }
}
