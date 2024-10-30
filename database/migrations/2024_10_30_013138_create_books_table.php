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
            $table->id('id');
            $table->text('book_name');
            $table->enum('genre',
                    ['romance',
                    'educational',
                    'self_help',
                    'horror',
                    'action',
                    'chic_flic',
                    "childrens_book",
                    'fantasy',
                    'mystery_thriller',
                    'fiction',
                    'political'
                ]);
            $table->text('author');
            $table->text('book_overview')->nullable();
            $table->decimal('price');
            $table->year('year_published');
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
