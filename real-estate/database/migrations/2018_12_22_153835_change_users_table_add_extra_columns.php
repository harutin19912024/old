<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeUsersTableAddExtraColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->unique()->after('id');
            $table->string('license')->nullable()->after('email');
            $table->date('license_expired_at')->nullable()->after('license');
            $table->decimal('commision', 3, 2)->nullable()->after('license_expired_at');
            $table->string('mls_id')->nullable()->after('commision');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['username', 'license', 'license_expired_at', 'commision', 'mls_id']);
        });
    }
}
