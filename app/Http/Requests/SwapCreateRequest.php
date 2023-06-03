<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class SwapCreateRequest extends FormRequest
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
    public function rules()
    {
        return [
          'bookAuthor'=>'required|string|max:255,min:1',
            'bookName'=>'required|string|max:255,min:1',
            'description'=>'max:1024',
            'bookAuthor2'=>'max:255',
            'bookName2'=>'max:255',
            'city'=>'max:256',
            'swapUpdateId'=>'int',
        ];
    }
    public function attributes()
    {
        return [
            'bookAuthor' => 'автор вашей книги',
            'bookName'=>'название вашей книги',
            'description'=>'описание вашей книги',
            'bookAuthor2'=>'автор желаемой книги',
            'bookName2'=>'название желаемой книги',
            'city'=>'ваш город'
        ];
    }

}
