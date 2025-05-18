<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVideoUrlToProductsTable extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('video_url')->nullable()->after('is_featured');
            $table->dropColumn('photo');
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->text('photo')->nullable()->after('description');
            $table->dropColumn('video_url');
        });
    }
}