<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeDealsTableAddDueDatesCheckboxes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('deals', function (Blueprint $table) {
            $table->tinyInteger('inspection_passed')->default(0)->after('inspection_date');
            $table->tinyInteger('pns_passed')->default(0)->after('pns_date');
            $table->tinyInteger('mortage_contingency_passed')->default(0)->after('mortage_contingency_date');
            $table->integer('user_id')->unsigned()->after('type');
            
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->OnDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('deals', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn(['inspection_passed', 'pns_passed', 'mortage_contingency_passed', 'user_id']);
        });
    }
}
