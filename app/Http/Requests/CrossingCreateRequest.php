<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CrossingCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'bookCover' => 'image|max:4096',
            'descriptionPlaces' => 'max:1024',
            'bookLocation' => 'required|string|max:1024',
            'city' => 'max:255',
            'status' => 'required',
            'bookISBN' => 'max:50',
            'bookName' => 'required|string|max:255',
            'bookAuthor' => 'required|string|max:255',
        ];
    }

    public function attributes(): array
    {
        return [
            'bookCover' => 'обложка книги',
            'descriptionPlaces' => 'описание местонахождения',
            'bookLocation' => 'местонахождение',
            'city' => 'город',
            'status' => 'статус',
            'bookISBN' => 'ISBN код книги',
            'bookName' => 'название книги',
            'bookAuthor'=>'Автор книги'

        ];
    }
}
