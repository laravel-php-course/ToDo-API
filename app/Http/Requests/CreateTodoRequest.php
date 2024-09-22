<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\DB;

class CreateTodoRequest extends FormRequest
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
    protected function getMaxLengthForTitle()
    {
        $result = DB::select("
            SELECT CHARACTER_MAXIMUM_LENGTH
            FROM information_schema.columns
            WHERE table_name = 'todos'
            AND column_name = 'title'
        ");

        return $result[2]->CHARACTER_MAXIMUM_LENGTH ;
    }

    public function rules(): array
    {

        return [
            'title' => 'required|string|max:'.$this->getMaxLengthForTitle(), //TODO fix it clean code done
            'body'  => 'required|string',
            'status'=> 'nullable|in:todo,in-progress,done',
            'schedule_time' => 'nullable'
            //TODO user
        ];
    }


    public function failedValidation(Validator $Validator)
    {
        throw new HttpResponseException(response()->json([
            'data' => $Validator->errors()
        ])) ;

    }
}
