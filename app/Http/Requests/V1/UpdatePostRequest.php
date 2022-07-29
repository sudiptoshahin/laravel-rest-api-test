<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
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
        $method = $this->method;
        if($method == 'PUT') {
            return [
                'title' => ['required'],
                'text' => ['required'],
                'updatedAt' => ['required']
            ];
        } else {
            return [
                'title' => ['sometimes', 'required'],
                'text' => ['sometimes', 'required'],
                'updatedAt' => ['sometimes', 'required']
            ];
        }
    }

    protected function prepareForValidation()
    {
        if($this->updatedAt) {
            $this->merge([
                'updated_at' => $this->updatedAt
            ]);
        }
    }
}
