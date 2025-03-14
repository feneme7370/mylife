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
        Schema::create('media', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->string('slug');

            $table->string('original_title')->nullable();
            $table->integer('emission_status')->nullable(); // 1 finalizada - 2 en emision - 3 cancelada
            $table->string('format')->nullable(); // 1 TV - 2 Cine
            $table->string('is_favorite')->nullable(); // 0 false - 1 true
            $table->string('is_wish')->nullable(); // 0 false - 1 true

            $table->text('synopsis')->nullable();
            $table->date('release_date')->nullable();

            $table->integer('number_collection')->nullable();
            $table->integer('duration')->nullable();
            $table->integer('rating')->nullable();
            $table->longText('personal_description')->nullable();
            
            $table->integer('media_type')->nullable(); // 1 pelicula - 2 serie
            
            // serie
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();

            $table->string('cover_image')->nullable();
            $table->text('cover_image_url')->nullable();
            
            $table->string('uuid')->unique();
            $table->integer('status')->nullable(); // 1 => 'Quiero ver', 2 => 'Visto', 3 => 'Viendo', 4 => 'Re-vista', 5 => 'Abandonada'
            
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};
