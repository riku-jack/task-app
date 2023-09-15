<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Task;

class UpdateTaskRequest extends FormRequest
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
        $myTaskStatusRule = Rule::in(array_keys(Task::TASK_STATUS_STRING));

        return [
            'task_name' => 'required|max:100|string',
            'task_status' => ['required', $myTaskStatusRule],
            'due_date' => 'required|date',
        ];
    }

    public function attributes()
    {
        return [
            'task_name' => 'タスク名',
            'task_status' => '進捗',
            'due_date' => '期限',
        ];
    }

    public function messages()
    {
        $statuses = implode('、', array_values(Task::TASK_STATUS_STRING));

        return [
            'task_status.in' => ':attributeには' . $statuses .'のいずれかを選択してください。',
        ];
    }
}
