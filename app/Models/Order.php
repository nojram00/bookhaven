<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        'user_id',
        'book_id',
        'date_ordered'
    ];

    public function ordered_books()
    {
        return $this->belongsTo(Book::class, 'book_id', 'id');
    }

    public function ordered_users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
