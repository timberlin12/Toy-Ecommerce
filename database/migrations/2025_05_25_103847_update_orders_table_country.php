UpdateOrdersTableCountry<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateOrdersTableCountry extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('country')->default('India')->change();
            // Or use: $table->string('country')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('country')->default(null)->change();
        });
    }
}
