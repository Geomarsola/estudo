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
        Schema::create('deleted_products_log', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id'); // ID do produto deletado
            $table->string('name');
            $table->text('description');
            $table->decimal('price', 10, 2);
            $table->integer('stock');
            $table->unsignedBigInteger('deleted_by'); // ID do admin que deletou
            $table->timestamps();

            // Chaves estrangeiras (opcional)
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deleted_products_log');
    }
};
