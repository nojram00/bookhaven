<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_name',
        'genre',
        'author',
        'book_overview',
        'price',
        'date_published'
    ];

    const GENRE =
        [
            'romance',
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
        ];
}
