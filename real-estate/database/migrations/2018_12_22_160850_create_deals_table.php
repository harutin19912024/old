<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deals', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('type', ['buy', 'sell', 'rent']);
            $table->string('property_address')->nullable();
            $table->string('mls')->nullable();
            $table->decimal('price', 8, 2)->nullable();
            $table->decimal('seller_commision', 6, 2)->nullable();
            $table->decimal('buyer_commision', 6, 2)->nullable();
            $table->date('offer_date')->nullable();
            $table->dateTime('inspection_date')->nullable();
            $table->dateTime('pns_date')->nullable();
            $table->dateTime('mortage_contingency_date')->nullable();
            $table->dateTime('closing_date')->nullable();
            $table->integer('deal_status_id')->nullable()->unsigned();
            $table->string('email')->nullable();
            $table->timestamps();
            
            $table->foreign('deal_status_id')->references('id')->on('deal_statuses')->onUpdate('cascade')->OnDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deals');
    }
}
