<?php

namespace App\Http\Requests;

use App\Rules\BookGenre;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBookInfo extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'book_name' => ['required','string'],
            'author' => ['required','string'],
            'price' => ['required','numeric'],
            'genre' => ['string', new BookGenre()],
            'cover_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'year_published' => ['required', 'digits:4', 'integer', 'before_or_equal:' . date('Y')]
        ];
    }

    public function store_file()
    {
        if ($this->hasFile('cover_photo'))
        {
            $path = $this->file('cover_photo')->store('cover_photo', 'public');

            return $path;
        }

        return null;
    }

    public function inputs()
    {
        return [
            'book_name' => $this->input('book_name'),
            'author' => $this->input('author'),
            'price' => $this->input('price'),
            'genre' => $this->input('genre'),
            'book_overview' => $this->input('book_overview'),
            'cover_photo' => $this->store_file(),
            'year_published' => $this->input('year_published')
        ];
    }
}
