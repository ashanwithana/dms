<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('deliveries', function (Blueprint $table) {
        $table->id();
        $table->string('pickup_address');
        $table->string('pickup_name');
        $table->string('pickup_contact_no');
        $table->string('pickup_email')->nullable();
        $table->string('delivery_address');
        $table->string('delivery_name');
        $table->string('delivery_contact_no');
        $table->string('delivery_email')->nullable();
        $table->string('type_of_good');
        $table->string('delivery_provider');
        $table->string('priority');
        $table->date('shipment_pickup_date');
        $table->time('shipment_pickup_time');
        $table->timestamps();
        $table->softDeletes();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deliveries');
    }
};
