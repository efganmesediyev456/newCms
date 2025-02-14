<?php

namespace App\Http\Requests\Customers;

use Illuminate\Foundation\Http\FormRequest;

class CustomerSaveRequest extends FormRequest
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
            'voen' => 'required',
            'fin_code' => 'required',
            'company_name' => 'required',
            'domen_names' => 'required',
            'director' => 'required',
            'customer_phone' => 'required',
            'responsible_persons' => 'required',
            'customer_type' => 'required',
            'customer_source_id' => 'required',
            'files.*' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx', 
        ];
    }

    public function messages(): array
    {
        return [
            'voen.required' => 'Vöen mütləq olmalıdır.',
            'fin_code.required' => 'Fin kod mütləq olmalıdır.',
            'company_name.required' => 'Şirkət adı mütləq olmalıdır.',
            'domen_names.required' => 'Domenlər mütləq olmalıdır.',
            'director.required' => 'Direktor mütləq olmalıdır.',
            'customer_phone.required' => 'Müştəri əlaqə nömrəsi mütləq olmalıdır.',
            'responsible_persons.required' => 'Məsul şəxslər mütləq olmalıdır.',
            'customer_type.required' => 'Müştəri növü mütləq seçilməlidir.',
            'customer_source_id.required' => 'Mənbə mütləq seçilməlidir.',
            'files.*.file' => 'Yüklənən müqavilə düzgün formatda olmalıdır.',
            'files.*.mimes' => 'Yüklənən müqavilə yalnız PDF, Word (doc, docx), Excel (xls, xlsx) formatları olmalıdır.',
        ];
    }
}
