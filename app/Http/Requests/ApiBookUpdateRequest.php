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
class ApiBookUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'publisher_id' => ['required', 'integer', 'exists:App\Models\Publisher,id'],
            'title' => ['required', 'string', 'max:255'],
            'image' => ['image', 'max:2000'],
            'description' => ['string', 'max:5000'],
            'published' => ['boolean'],
            'sort' => ['integer'],
            'authors' => ['required', 'min:1'],
            'authors.*' => ['required', 'integer', 'exists:App\Models\Author,id'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
