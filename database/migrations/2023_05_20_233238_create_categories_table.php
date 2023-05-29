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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->string("slug")->unique();
            $table->string("photo")->nullable();
            $table->boolean("is_parent")->default(true);
            $table->mediumText("summary")->nullable();
            $table->unsignedBigInteger("parent_id")->nullable();
            $table->foreign("parent_id")->references('id')->on('categories')->onDelete('SET NULL');
            $table->enum("status",["active", "inactive"])->default("active");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
