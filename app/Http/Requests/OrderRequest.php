<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrderRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'type' => ['required',Rule::in(['dine-in','delivery','takeaway'])],
            'customer_name' => 'required',
            'customer_phone' => 'required_if:type,delivery',
            'delivery_fees' => 'required_if:type,delivery',
            'table_number' => 'required_if:type,dine-in',
            'service_charge' => 'required_if:type,dine-in',
            'waiter_name' => 'required_if:type,dine-in',
            "items" => ['array','required',Rule::in(get_all_menu_items(['id'])->pluck('id'))]
        ];
    }
}
