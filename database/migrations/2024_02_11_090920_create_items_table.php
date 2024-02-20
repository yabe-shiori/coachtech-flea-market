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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->foreignId('brand_id')->nullable()->constrained()->onDelete('cascade');
            $table->decimal('price', 10, 2);
            $table->enum('condition', [
                '新品、未使用',
                '未使用に近い',
                '目立った傷や汚れなし',
                'やや傷や汚れあり',
                '傷や汚れあり',
                '全体的に状態が悪い'
            ]);
            $table->text('description')->nullable();
            $table->boolean('is_sold')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
