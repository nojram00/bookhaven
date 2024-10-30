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
            'date_published' => ['date']
        ];
    }
}
