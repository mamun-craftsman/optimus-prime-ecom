<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->foreignId('subcategory_id')->constrained()->cascadeOnDelete();
            $table->text('key_feature_left');
            $table->text('key_feature_right');
            $table->decimal('price', 10, 2);
            $table->longText('description');
            $table->string('primary_image');
            $table->json('secondary_images');
            $table->string('video_url')->nullable();
            $table->integer('stock')->default(0);
            $table->enum('status', ['sell', 'sold'])->default('sell');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
