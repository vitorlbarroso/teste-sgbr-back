<?php

namespace App\Http\Requests\Locations;

use Illuminate\Foundation\Http\FormRequest;

class CreateLocationsRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
        ];
    }

    public function messages(){

        return [
            'name.required' => 'O campo "name" é obrigatório!',
            'name.string' => 'O campo "name" deverá ser do tipo string!',
            'name.max' => 'O campo "name" deverá conter no mínimo 1 caractere!',

            'slug.required' => 'O campo "slug" é obrigatório!',
            'slug.string' => 'O campo "slug" deverá ser do tipo string!',
            'slug.max' => 'O campo "slug" deverá conter no mínimo 1 caractere!',

            'city.required' => 'O campo "city" é obrigatório!',
            'city.string' => 'O campo "city" deverá ser do tipo string!',
            'city.max' => 'O campo "city" deverá conter no mínimo 1 caractere!',

            'state.required' => 'O campo "state" é obrigatório!',
            'state.string' => 'O campo "state" deverá ser do tipo string!',
            'state.max' => 'O campo "state" deverá conter no mínimo 1 caractere!',
        ];

    }
}
