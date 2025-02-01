<?php

namespace App\Http\Requests\Orders;

use Illuminate\Foundation\Http\FormRequest;

class OrderSaveRequest extends FormRequest
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
            'application_date' => 'required|date_format:Y-m-d',
            'customer_name' => 'required',
            'phone' => 'required',
            'source_id' => 'required',
            'call_status_id' => 'required',
            'order_status_id' => 'required',
            'request' => 'required',
            'price_offer' => 'required',
            'note' => 'required',
            'call_date' => 'required|date_format:Y-m-d',
        ];
    }
    public function messages(): array
    {
        return [
            'application_date.required' => 'Müraciət Tarixi mütləq olmalıdır.',
            'call_date.required' => 'Zəng Tarixi mütləq olmalıdır.',
            'application_date.date_format' => 'Müraciət Tarixi "yyyy:mm:dd" formatında olmalıdır.',
            'call_date.date_format' => 'Müraciət Tarixi "yyyy:mm:dd" formatında olmalıdır.',
            'customer_name.required' => 'Müştəri Adı mütləq olmalıdır.',
            'phone.required' => 'Telefon mütləq olmalıdır.',
            'source_id.required' => 'Mənbə mütləq seçilməlidir.',
            'call_status_id.required' => 'Zəng Statusu  mütləq seçilməlidir.',
            'order_status_id.required' => 'Sifariş Statusu mütləq seçilməlidir.',
            'request.required' => 'Istək mütləq seçilməlidir.',
            'price_offer.required' => 'Qiymət Təklifi mütləq seçilməlidir.',
            'note.required' => 'Qeyd mütləq seçilməlidir.',
           ];
    }
}
