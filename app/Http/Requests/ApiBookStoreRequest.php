<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $title
 * @property bool $image
 * @property bool $description
 * @property bool $published
 * @property int $sort
 * @property string[] $authors
 */
class ApiBookStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'image' => ['image', 'max:2000'],
            'description' => ['string', 'max:5000'],
            'published' => ['boolean'],
            'sort' => ['integer'],
            'authors' => ['required', 'min:1'],
            'authors.*' => ['required', 'string', 'max:255'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
