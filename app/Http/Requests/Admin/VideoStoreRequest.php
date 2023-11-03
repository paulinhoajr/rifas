<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class VideoStoreRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'escola_id' => ['nullable'],
            'cidade_id' => ['required'],
            'nome' => ['required'],
            'url' => ['nullable'],
            'descricao' => ['required'],
            'situacao' => ['nullable'],
        ];
    }

    protected function prepareForValidation()
    {

    }
}
