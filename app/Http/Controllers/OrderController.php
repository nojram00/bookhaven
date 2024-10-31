<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Order;
use App\Models\User;
use App\Providers\BookOrderProvider;
use App\Services\BookhavenService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class OrderController extends Controller
{
    protected $service;
    public function __construct(BookhavenService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $orders = Order::query();


        $orders = $orders->paginate(10);

        return Inertia::render('OrderDashboard',[
            'orders' => $orders
        ]);
    }

    public function order(Book $book, Request $request)
    {

        $result = $this->service->create_order(Auth::user(), $book);

        $data = Order::with('ordered_books', 'ordered_users')->find($result->id);

        if($result != null)
        {
            $this->service->save_to_log("Add new order, $data->id");
            return redirect(route('order-info', $data->id))
                        ->with('message', "Checkout Success! Order Id: $data->id")
                        ->with('history', $request->header('X-History'));
        }

        return redirect(route('books'))->with('error', "Checkout error. Something went wrong...");

    }

    public function user_orders()
    {
        $auth_user = Auth::user();

        $user = User::find($auth_user->id);

        // return $user->user_orders()->paginate(10);
        return Inertia::render('MyOrders', [
            'orders' => $user->user_orders()->paginate(10)
        ]);
    }

    public function order_info(Order $order)
    {
        return Inertia::render('OrderDetails', [
            'order_info' => $order,
            'book_info' => $order->ordered_books,
            'user_info' => $order->ordered_users
        ]);
    }
}
