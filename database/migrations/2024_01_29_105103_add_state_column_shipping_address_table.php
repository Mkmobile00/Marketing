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
        Schema::table('user_shipping_addresses', function (Blueprint $table) {
            // $table->string('state')->nullable();
            $table->string('random_ref_id')->unique()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_shipping_addresses', function (Blueprint $table) {
            // $table->dropColumn('state');
            // $table->dropColumn('random_ref_id');
        });
    }
};
