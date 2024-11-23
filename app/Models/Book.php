<?php

namespace App\Models;

use App\Services\AppwriteStorageService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Response;

class Book extends Model
{
    use HasFactory;

    protected $appends = [
        'cover_image'
    ];

    protected $fillable = [
        'book_name',
        'genre',
        'author',
        'book_overview',
        'price',
        'cover_photo',
        'year_published'
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

    public function getCoverImageAttribute()
    {
        if($this->cover_photo)
        {
            return route('image', ['fileId' => $this->cover_photo]);
        }

        return null;
    }
}
