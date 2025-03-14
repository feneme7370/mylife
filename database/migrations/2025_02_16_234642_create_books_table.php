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

            $table->string('original_title')->nullable();
            $table->string('emission_status')->nullable();
            $table->string('format')->nullable(); // 1 Libro - 2 Digital - 3 Audiolibro 
            $table->string('is_favorite')->nullable(); // 0 false - 1 true
            $table->string('is_wish')->nullable(); // 0 false - 1 true

            $table->text('synopsis')->nullable();
            $table->date('release_date')->nullable();

            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            
            $table->integer('number_collection')->nullable();
            $table->integer('media_type')->nullable(); // 1 libro - 2 manga

            $table->integer('pages')->nullable();
            $table->integer('rating')->nullable();
            $table->longText('personal_description')->nullable();

            $table->string('cover_image')->nullable();
            $table->text('cover_image_url')->nullable();
            
            $table->integer('status')->nullable(); // 1 sin leer - 2 leido - 3 leyendo
            $table->string('uuid')->unique();

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
