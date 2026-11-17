<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoomRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nom'      => 'required|string|min:2|max:100',
            'batiment' => 'required|string|max:50',
            'capacite' => 'required|integer|min:1',
        ];
    }
}