<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Todo;

class UpdateTodoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // return auth()->user()->id == ;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:' . Todo::TITLE_MAX_LENGTH,
            'body'  => 'nullable|string|max:' . Todo::BODY_MAX_LENGTH,
            'status'=> 'in:' . implode(',', Todo::STATUSES),
        ];
    }
}
