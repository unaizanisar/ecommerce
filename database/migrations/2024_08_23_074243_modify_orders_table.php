<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            if (!Schema::hasColumn('orders', 'billing_first_name')) {
                $table->string('billing_first_name')->nullable();
            }
            if (!Schema::hasColumn('orders', 'billing_last_name')) {
                $table->string('billing_last_name')->nullable();
            }
            if (!Schema::hasColumn('orders', 'billing_email')) {
                $table->string('billing_email')->nullable();
            }
            if (!Schema::hasColumn('orders', 'billing_address')) {
                $table->text('billing_address')->nullable();
            }
            if (!Schema::hasColumn('orders', 'billing_city')) {
                $table->string('billing_city')->nullable();
            }
            if (!Schema::hasColumn('orders', 'billing_district')) {
                $table->string('billing_district')->nullable();
            }
            if (!Schema::hasColumn('orders', 'billing_postcode')) {
                $table->string('billing_postcode')->nullable();
            }
            if (!Schema::hasColumn('orders', 'shipping_first_name')) {
                $table->string('shipping_first_name')->nullable();
            }
            if (!Schema::hasColumn('orders', 'shipping_last_name')) {
                $table->string('shipping_last_name')->nullable();
            }
            if (!Schema::hasColumn('orders', 'shipping_email')) {
                $table->string('shipping_email')->nullable();
            }
            if (!Schema::hasColumn('orders', 'shipping_address')) {
                $table->text('shipping_address')->nullable();
            }
            if (!Schema::hasColumn('orders', 'shipping_city')) {
                $table->string('shipping_city')->nullable();
            }
            if (!Schema::hasColumn('orders', 'shipping_district')) {
                $table->string('shipping_district')->nullable();
            }
            if (!Schema::hasColumn('orders', 'shipping_postcode')) {
                $table->string('shipping_postcode')->nullable();
            }
            if (!Schema::hasColumn('orders', 'special_notes')) {
                $table->text('special_notes')->nullable();
            }
            if (!Schema::hasColumn('orders', 'payment_method')) {
                $table->string('payment_method')->nullable();
            }

            // Drop the tax column if it exists
            if (Schema::hasColumn('orders', 'tax')) {
                $table->dropColumn('tax');
            }
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
            $table->dropColumn([
                'billing_first_name', 'billing_last_name', 'billing_email',
                'billing_address', 'billing_city', 'billing_district',
                'billing_postcode', 'shipping_first_name', 'shipping_last_name',
                'shipping_email', 'shipping_address', 'shipping_city',
                'shipping_district', 'shipping_postcode', 'special_notes',
                'payment_method'
            ]);

            $table->decimal('tax', 10, 2)->nullable();
        });
    }
}
