<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property int $user_id
 * @property int $book_id
 */
class ApiFavoriteRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_id' => ['required', 'int', 'exists:App\Models\User'],
            'book_id' => ['required', 'int', 'exists:App\Models\Book'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
