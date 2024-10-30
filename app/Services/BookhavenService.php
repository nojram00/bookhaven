<?php

namespace App\Services;

use App\Models\Book;
use App\Models\Order;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;

class BookhavenService {

    public function create_order(User $user, Book $book)
    {

        DB::beginTransaction();
        // create an order:
        try {

            $new_order = new Order([
                'user_id' => $user->id,
                'book_id' => $book->id,
                'date_ordered' => now()
            ]);

            $new_order->save();

            DB::commit();

            return $new_order;

        } catch (Exception $e) {

            DB::rollBack();

            return null;
        }
    }
}
