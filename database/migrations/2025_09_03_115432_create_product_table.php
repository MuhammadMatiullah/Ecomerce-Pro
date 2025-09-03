<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('slug')->unique();
        $table->unsignedBigInteger('category_id');
        $table->unsignedBigInteger('subcategory_id');
        $table->decimal('price', 10, 2);
        $table->decimal('discount', 5, 2)->nullable();
        $table->integer('quantity')->default(0);
        $table->json('size')->nullable();
        $table->json('color')->nullable();
        $table->text('description');
        $table->string('image');
        $table->boolean('status')->default(1);
        $table->timestamps();

        // ✅ Foreign Keys
        $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
       $table->foreign('subcategory_id')->references('id')->on('sub_categories')->onDelete('cascade');

    });
}


    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
