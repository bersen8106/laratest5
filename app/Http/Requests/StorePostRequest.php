<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|min:5',
            'slug' => 'nullable',
            'excerpt' => 'required|min:10',
            'body' => 'required|min:10',
            'is_published' => 'sometimes|boolean',
            'published_at' => 'nullable',
            'user_id' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Пожалуйста введите заголовок',
            'excerpt.required' => 'Пожалуйста введите короткое превью',
            'body.required' => 'Пожалуйста введите текст поста',
            'image.image' => 'Файл должен быть изображением',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_published' => $this->boolean('is_published'),   // нормализуем поле is_published
        ]);
    }
}
