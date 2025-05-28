<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class UpdateOrdersTableForRazorpay extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            // Add Razorpay order ID
            $table->string('razorpay_order_id')->nullable()->after('order_number');
        });

        // Modify enum using raw SQL
        DB::statement("ALTER TABLE orders MODIFY COLUMN payment_method ENUM('cod', 'razorpay', 'cardpay') DEFAULT 'cod'");
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('razorpay_order_id');
        });

        // Revert enum values
        DB::statement("ALTER TABLE orders MODIFY COLUMN payment_method ENUM('cod', 'paypal') DEFAULT 'cod'");
    }
}
