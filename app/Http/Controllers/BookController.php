<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBookRequest;
use App\Http\Requests\UpdateBookInfo;
use App\Models\Book;
use App\Rules\BookGenre;
use App\Services\BookhavenService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class BookController extends Controller
{

    protected $service;
    /**
     *  Injects the Bookhaven Service which handles writing logs and creating orders.
     *
     *
     */

    public function __construct(BookhavenService $service)
    {
        $this->service = $service;
    }

    /**
     *  This action displays the 'books' page which accessible to users and admin
     */
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

    /**
     * This action is for displaying the dashboard together with the data from the database.
     */
    public function book_dashboard()
    {
        $books = Book::query();


        $books = $books->paginate(10);

        return Inertia::render('BookDashboard', [
            'books' => $books,
        ]);
    }
    /**
     * This action is for displaying the 'Edit book' page.
     */
    public function edit_book(Book $book)
    {

        return Inertia::render('Books/EditBook', [
            'book' => $book,
            'genre' => Book::GENRE
        ]);
    }

    /**
     *  Handles the book editing.
     */
    public function save_book(Book $book, Request $request)
    {

        if ($request->hasFile('cover_photo'))
        {
            $path = $request->file('cover_photo')->store('cover_photo', 'public');
        }

        $updated = $book->update([
            'book_name' => $request->input('book_name'),
            'author' => $request->input('author'),
            'price' => $request->input('price'),
            'genre' => $request->input('genre'),
            'book_overview' => $request->input('book_overview'),
            'cover_photo' => $path ?? \null,
            'year_published' => $request->input('year_published')
        ]);

        if($updated)
        {
            $this->service->save_to_log("Edit book, $book->book_name");
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

    /**
     *  Handles the book creation.
     */
    public function create_book(Request $request)
    {

        $request->validate([
            'book_name' => ['required','string'],
            'author' => ['required','string'],
            'price' => ['required','numeric'],
            'genre' => ['required', new BookGenre()],
            'book_overview' => ['string'],
            'cover_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'year_published' => ['required', 'digits:4', 'integer', 'before_or_equal:' . date('Y')]
        ]);

        if($request->file('cover_photo'))
        {
            $path = $request->file('cover_photo')->store('cover_photo', 'public');
        }

        $book = Book::create(
            [
                'book_name' => $request->input('book_name'),
                'author' => $request->input('author'),
                'price' => $request->input('price'),
                'genre' => $request->input('genre'),
                'book_overview' => $request->input('book_overview'),
                'year_published' => $request->input('year_published'),
                'cover_photo' => $path ?? \null,
            ]
        );

        // dd($book);

        if($book)
        {
            $this->service->save_to_log("Create book, $book->book_name");
            return redirect(route('add-book'))->with('Message','Book Created!');
        }

        return redirect(route('add-book'))->with('Error', 'Book not created');
    }

    /**
     * For deleting books.
     */
    public function destroy(Book $book, Request $request)
    {
        $book_name = $book->book_name;
        $validated = $request->validate(
            ['password' => ['required', 'current_password']]
        );

        if($validated)
        {
            $deleted = $book->delete();

            if ($deleted)
            {
                $this->service->save_to_log("Delete book, $book_name");
                return redirect(route('dashboard'))->with('message','Book Deleted!');
            }
        }

        return redirect(route('dashboard'))->with('error','Book failed to delete.');


    }
}
