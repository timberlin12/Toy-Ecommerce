<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AlterRazorpayColumnsNullableInRazorpayPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE `razorpay_payments` MODIFY `razorpay_payment_id` VARCHAR(191) NULL");
        DB::statement("ALTER TABLE `razorpay_payments` MODIFY `razorpay_signature` VARCHAR(191) NULL");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE `razorpay_payments` MODIFY `razorpay_payment_id` VARCHAR(191) NOT NULL");
        DB::statement("ALTER TABLE `razorpay_payments` MODIFY `razorpay_signature` VARCHAR(191) NOT NULL");
    }
}
