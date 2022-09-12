<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderStoreRequest extends FormRequest
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
            "user_id" => "required|numeric",
            "payment_type" => "required",
            "paid" => "required",
            "user_shipping_details" => "required",
            "products" => "required_without:packages",
            "packages" => "required_without:products",
            "total_price" => "required",
            "type_of_packages" => "required"
        ];
    }
}
