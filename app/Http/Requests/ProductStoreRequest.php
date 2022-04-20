<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'product.basic_information.name' => 'required', 'max:255',
            'product.basic_information.unit_code' => 'required',
            'product.basic_information.weight' => 'required',
            'product.basic_information.width' => 'required',
            'product.basic_information.height' => 'required',
            'product.basic_information.length' => 'required',
            'product.basic_information.selectedCategories' => 'required',
            'product.basic_information' => 'required',
            'product.basic_information' => 'required',
            'product.vat' => 'required',
            'product.basic_information' => 'required',
            'price' => 'required|numeric',
            'price_supplier' => 'required',
        ];
    }
}
