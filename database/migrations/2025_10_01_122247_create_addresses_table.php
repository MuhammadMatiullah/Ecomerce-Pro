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
    Schema::create('addresses', function (Blueprint $table) {
        $table->id();

        // Link address to user
        $table->unsignedBigInteger('user_id');  
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        // Personal details
        $table->string('first_name');
        $table->string('last_name');
        $table->string('email');
        $table->string('telephone');
        $table->string('fax')->nullable();
        $table->string('company')->nullable();

        // Address details
        $table->string('address1');
        $table->string('address2')->nullable();
        $table->string('city');
        $table->string('postcode');
        $table->string('country');
        $table->string('region_state');

        // Boolean flags
        $table->boolean('is_billing')->default(false);
        $table->boolean('is_delivery')->default(false);

        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
