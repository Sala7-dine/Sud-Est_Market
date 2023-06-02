<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->string("slug")->unique();
            $table->mediumText("summary");
            $table->string("photo");
            $table->longText("description")->nullable();
            $table->integer("stock")->default(0);
            $table->unsignedBigInteger("brand_id");
            $table->unsignedBigInteger("cat_id");
            $table->unsignedBigInteger("child_cat_id")->nullable();
            $table->float("price")->default(0);
            $table->float("offre_price")->default(0);
            $table->float("discount")->default(0);
            $table->string("size");
            $table->enum("conditions" , ["NEW" , "POPULAR" , "WINTER"])->default("NEW");
            $table->unsignedBigInteger('vendor_id')->nullable();
            $table->enum("status" , ["active" , "inactive"])->default('active');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete("cascade");
            $table->foreign('cat_id')->references('id')->on('categories')->onDelete("cascade");
            $table->foreign('child_cat_id')->references('id')->on('categories')->onDelete("SET NULL");
            $table->foreign('vendor_id')->references('id')->on('users')->onDelete("SET NULL");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
