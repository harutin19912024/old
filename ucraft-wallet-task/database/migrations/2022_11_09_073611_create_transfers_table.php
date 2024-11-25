<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfers', function (Blueprint $table) {
            $table->id();
            $table->morphs('from');
            $table->morphs('to');
            $table->enum('status', ['transfer', 'paid', 'refund'])->default('transfer');
            $table->unsignedBigInteger('deposit_id');
            $table->unsignedBigInteger('withdraw_id');
            $table->uuid('uuid')->unique();
            $table->timestamps();

            $table->foreign('deposit_id')
                ->references('id')
                ->on('transactions')
                ->onDelete('cascade');

            $table->foreign('withdraw_id')
                ->references('id')
                ->on('transactions')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transfers');
    }
};
