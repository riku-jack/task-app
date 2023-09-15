<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

   /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'task_name' => 'required|max:100|string',
            'due_date' => 'required|date|after_or_equal:today',
        ];
    }

    public function attributes()
    {
        return [
            'task_name' => 'タスク名',
            'due_date' => '期限',
        ];
    }

    public function messages()
    {
        return [
            'due_date.after_or_equal' => ':attributeには今日以降の日付を指定してください。',
        ];
    }

}
