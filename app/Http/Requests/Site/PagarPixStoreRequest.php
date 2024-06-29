<?php

namespace App\Http\Requests\Site;

use App\Models\Usuario;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class PagarPixStoreRequest extends FormRequest
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
            'id' => ['required'],
            'numeros' => ['required'],
            'valor' => ['required'],
        ];
    }

    protected function prepareForValidation()
    {
        //dd($this);
    }
}
