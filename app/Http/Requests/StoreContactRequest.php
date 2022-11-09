<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
//Aqui se podria autorizar con policies
        // return $this->user()->can('update', $this->contact);
        //pero habria que que crear varios StoreRequest para que haya autoricaciones segun la acción
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
            'name' => 'required',
            'email' => ['required', 'email'],
            'phone_number' => ['required', 'digits:9'],
            'age' => 'required|numeric|min:1|max:250',
        ];
    }
}
