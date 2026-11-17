<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInterventionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'date'        => 'required|date|before_or_equal:today',
            'type'        => 'required|string|max:100',
            'commentaire' => 'nullable|string|max:1000',
        ];
    }
}