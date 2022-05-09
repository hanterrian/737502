<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $name
 * @property bool $published
 * @property int $sort
 */
class ApiPublisherStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'published' => ['boolean'],
            'sort' => ['int'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
