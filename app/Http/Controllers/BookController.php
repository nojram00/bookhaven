<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBookRequest;
use App\Http\Requests\UpdateBookInfo;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class BookController extends Controller
{
    public function index(Request $request)
    {

        $req = $request->all();

        $books = Book::query();

        $genre = Book::GENRE;

        $current = [];

        if(!empty($req) && array_key_exists('category', $req))
        {
            $category = $req['category']; // Supposed category has ['fiction','horror']

            $books = $books->whereIn('genre', $category);

            $current = array_merge($current, $category);
        }

        $books = $books->paginate(6);

        // dd($books);
        return Inertia::render('OrderPage', [
            'books' => $books,
            'genre' => $genre,
            'current' => $current
        ]);
    }

    public function featured_books()
    {
        $books = Book::query()
                ->whereYear('created_at', now()->year)
                ->whereMonth('created_at', now()->month)
                ->orderBy('created_at', 'asc')
                ->take(5);


        // Log::info($books->toSql());
        // Log::info($books->getBindings());

        $books = $books->get();
        return Inertia::render('Featured',[
            'books' => $books
        ]);
    }

    public function book_dashboard()
    {
        $books = Book::query();


        $books = $books->paginate(10);

        return Inertia::render('BookDashboard', [
            'books' => $books,
        ]);
    }

    public function edit_book(Book $book)
    {

        return Inertia::render('Books/EditBook', [
            'book' => $book,
            'genre' => Book::GENRE
        ]);
    }

    public function save_book(Book $book, UpdateBookInfo $request)
    {

        // dd($request->validated());

        $updated = $book->update($request->validated());

        if($updated)
        {
            return redirect(route('edit-book', $book))->with('Message', 'Book Updated!');
        }

        return redirect(route('edit-book', $book))->with('Error', 'Book not updated. Please try again');
    }

    public function create()
    {
        return Inertia::render('Books/CreateBook', [
            'genre' => Book::GENRE
        ]);
    }
    public function create_book(Request $request)
    {

        $book = Book::create($request->all());

        // dd($book);

        if($book)
        {
            return redirect(route('add-book'))->with('Message','Book Created!');
        }

        return redirect(route('add-book'))->with('Error', 'Book not created');
    }

    public function destroy(Book $book, Request $request)
    {
        $validated = $request->validate(
            ['password' => ['required', 'current_password']]
        );

        if($validated)
        {
            $deleted = $book->delete();

            if ($deleted)
            {
                return redirect(route('dashboard'))->with('message','Book Deleted!');
            }
        }

        return redirect(route('dashboard'))->with('error','Book failed to delete.');


    }
}
