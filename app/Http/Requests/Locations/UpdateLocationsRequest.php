<?php

namespace App\Http\Requests\Locations;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLocationsRequest extends FormRequest
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
            'name' => 'string|min:1|max:255',
            'slug' => 'string|min:1|max:255',
            'city' => 'string|min:1|max:255',
            'state' => 'string|min:1|max:255',
        ];
    }

    public function messages(){
        return [
            'name.string' => 'O campo "name" deverá ser do tipo string!',
            'name.min' => 'O campo "name" deverá conter no mínimo 1 caractere!',
            'name.max' => 'O campo "name" deverá conter no mínimo 1 caractere!',

            'slug.string' => 'O campo "slug" deverá ser do tipo string!',
            'slug.min' => 'O campo "slug" deverá conter no mínimo 1 caractere!',
            'slug.max' => 'O campo "slug" deverá conter no mínimo 1 caractere!',

            'city.string' => 'O campo "city" deverá ser do tipo string!',
            'city.min' => 'O campo "city" deverá conter no mínimo 1 caractere!',
            'city.max' => 'O campo "city" deverá conter no mínimo 1 caractere!',

            'state.string' => 'O campo "state" deverá ser do tipo string!',
            'state.min' => 'O campo "state" deverá conter no mínimo 1 caractere!',
            'state.max' => 'O campo "state" deverá conter no mínimo 1 caractere!',
        ];
    }
}
