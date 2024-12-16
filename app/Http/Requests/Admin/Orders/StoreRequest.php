<?php

namespace App\Http\Requests\Admin\Orders;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'service' => 'required|string',
            'shipping_price' => 'numeric|min:0',
            'time' => 'date_format:Y-m-d H:i:s|nullable',
            'notes' => 'string|nullable',
            'client_id' => 'required|exists:clients,id',
            
            'details' => 'required|array',

            'details.food_to' => 'required_if:service,Доставка їжі|string',
            'details.order_items' => 'required_if:service,Доставка їжі|array|min:1',
            'details.order_items.*.name' => 'required_if:service,Доставка їжі|string',
            'details.order_items.*.amount' => 'required_if:service,Доставка їжі|numeric|min:0',
            'details.order_items.*.quantity' => 'required_if:service,Доставка їжі|integer|min:1',
            'details.order_items.*.product_id' => 'required_if:service,Доставка їжі|exists:products,id',

            'details.shipping_from' => 'required_if:service,Кур\'єр|string',
            'details.shipping_to' => 'required_if:service,Кур\'єр|array|min:1',
            'details.shipping_to.*' => 'required_if:service,Кур\'єр|string',

            'details.taxi_from' => 'required_if:service,Таксі|string',
            'details.taxi_to' => 'required_if:service,Таксі|array|min:1',
            'details.taxi_to.*' => 'required_if:service,Таксі|string',
        ];
    }

    public function messages()
    {
        return [
            'details.order_items.min' => 'Замовлення повинно містити хоча б 1 елементів.',
            'details.order_items.required_if' => 'Замовлення є обов\'язковим, коли сервіс є Доставка їжі.',
        ];
    }
}