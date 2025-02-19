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
        Schema::create('books', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->string('slug');

            $table->longText('synopsis')->nullable();
            $table->date('release_date')->nullable();

            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            
            $table->integer('number_collection')->nullable();

            $table->integer('pages')->nullable();
            $table->integer('rating')->nullable();
            $table->text('personal_description')->nullable();

            $table->string('cover_image')->nullable();
            $table->string('cover_image_url')->nullable();
            
            $table->string('uuid')->unique();

            $table->string('status')->nullable(); // 1 sin leer - 2 leido - 3 leyendo

            $table->foreignId('book_author_id')->constrained()->onDelete('cascade');
            $table->foreignId('book_collection_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
