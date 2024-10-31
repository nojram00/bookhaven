<?php

namespace App\Services;

use App\Models\ActivityLog;
use App\Models\Book;
use App\Models\Order;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BookhavenService {

    /**
     * Handles the creation of order
     */
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

    public function save_to_log($message_log)
    {
        $user_id = Auth::user()->id;

        ActivityLog::create([
            'user_id' => $user_id,
            'log' => $message_log,
            'datetime' => \now()
        ]);

    }
}
