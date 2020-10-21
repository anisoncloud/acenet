<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->integer('customer_nid')->nullable()->default(null)->after('billing_name');
            $table->string('gander')->nullable()->default(null);
            $table->string('house')->nullable()->default(null);
            $table->string('road')->nullable()->default(null);
            $table->string('block')->nullable()->default(null);
            $table->string('area')->nullable()->default(null);
            $table->string('city')->nullable()->default(null);
            $table->integer('post_code')->nullable()->default(null);
            $table->date('connectivity_date')->nullable()->default(null);
            $table->text('note')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('customer_nid');
            $table->dropColumn('gander');
            $table->dropColumn('house');
            $table->dropColumn('road');
            $table->dropColumn('block');
            $table->dropColumn('area');
            $table->dropColumn('city');
            $table->dropColumn('post_code');
            $table->dropColumn('connectivity_date');
            $table->dropColumn('note');
        });
    }
}
