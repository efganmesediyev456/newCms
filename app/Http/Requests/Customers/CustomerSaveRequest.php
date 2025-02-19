<?php

namespace App\Http\Requests\Customers;

use Illuminate\Foundation\Http\FormRequest;

class CustomerSaveRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // Customer Main Information
            'voen' => 'required|string|max:20',
            'fin_code' => 'required|string|max:20',
            'company_name' => 'required|string|max:255',
            'domen_names' => 'required|string|max:255',
            'director' => 'required|string|max:100',
            'customer_phone' => 'required|string|max:20',
            'responsible_persons' => 'required|string|max:255',
            'customer_type' => 'required|integer',
            'customer_source_id' => 'required|integer',
            'files.*' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx|max:10240', 

            // Requisite Information
            'requisite.voen' => 'required|string|max:20',
            'requisite.legal_address' => 'required|string|max:255',
            'requisite.actual_address' => 'required|string|max:255',
            'requisite.bank' => 'required|string|max:100',
            'requisite.bank_voen' => 'required|string|max:20',
            'requisite.code' => 'required|string|max:50',
            'requisite.settlement_account' => 'required|string|max:50',
            'requisite.correspondent_account' => 'nullable|string|max:50',
            'requisite.swift' => 'required|string|max:20',
            'requisite.director' => 'required|string|max:100',
        ];
    }

    public function messages(): array
    {
        return [
            // Customer Main Information Messages
            'voen.required' => 'Vöen mütləq olmalıdır.',
            'voen.max' => 'Vöen maksimum 20 simvol ola bilər.',
            'fin_code.required' => 'Fin kod mütləq olmalıdır.',
            'fin_code.max' => 'Fin kod maksimum 20 simvol ola bilər.',
            'company_name.required' => 'Şirkət adı mütləq olmalıdır.',
            'company_name.max' => 'Şirkət adı maksimum 255 simvol ola bilər.',
            'domen_names.required' => 'Domenlər mütləq olmalıdır.',
            'domen_names.max' => 'Domenlər maksimum 255 simvol ola bilər.',
            'director.required' => 'Direktor mütləq olmalıdır.',
            'director.max' => 'Direktor maksimum 100 simvol ola bilər.',
            'customer_phone.required' => 'Müştəri əlaqə nömrəsi mütləq olmalıdır.',
            'customer_phone.max' => 'Müştəri əlaqə nömrəsi maksimum 20 simvol ola bilər.',
            'responsible_persons.required' => 'Məsul şəxslər mütləq olmalıdır.',
            'responsible_persons.max' => 'Məsul şəxslər maksimum 255 simvol ola bilər.',
            'customer_type.required' => 'Müştəri növü mütləq seçilməlidir.',
            'customer_source_id.required' => 'Mənbə mütləq seçilməlidir.',
            'files.*.file' => 'Yüklənən müqavilə düzgün formatda olmalıdır.',
            'files.*.mimes' => 'Yüklənən müqavilə yalnız PDF, Word (doc, docx), Excel (xls, xlsx) formatları olmalıdır.',
            'files.*.max' => 'Müqavilə faylının maksimum ölçüsü 10 MB ola bilər.',

            // Requisite Information Messages
            'requisite.voen.required' => 'Requisite Vöen mütləq olmalıdır.',
            'requisite.voen.max' => 'Requisite Vöen maksimum 20 simvol ola bilər.',
            'requisite.legal_address.required' => 'Hüquqi ünvan mütləq olmalıdır.',
            'requisite.legal_address.max' => 'Hüquqi ünvan maksimum 255 simvol ola bilər.',
            'requisite.actual_address.required' => 'Faktiki ünvan mütləq olmalıdır.',
            'requisite.actual_address.max' => 'Faktiki ünvan maksimum 255 simvol ola bilər.',
            'requisite.bank.required' => 'Bank mütləq olmalıdır.',
            'requisite.bank.max' => 'Bank maksimum 100 simvol ola bilər.',
            'requisite.bank_voen.required' => 'Bank Vöen mütləq olmalıdır.',
            'requisite.bank_voen.max' => 'Bank Vöen maksimum 20 simvol ola bilər.',
            'requisite.code.required' => 'Kod mütləq olmalıdır.',
            'requisite.code.max' => 'Kod maksimum 50 simvol ola bilər.',
            'requisite.settlement_account.required' => 'Hesablaşma hesabı mütləq olmalıdır.',
            'requisite.settlement_account.max' => 'Hesablaşma hesabı maksimum 50 simvol ola bilər.',
            'requisite.swift.required' => 'SWIFT kodu mütləq olmalıdır.',
            'requisite.swift.max' => 'SWIFT kodu maksimum 20 simvol ola bilər.',
            'requisite.director.required' => 'Requisite direktor mütləq olmalıdır.',
            'requisite.director.max' => 'Requisite direktor maksimum 100 simvol ola bilər.',
        ];
    }

    // Optional: Custom validation method if needed
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            // Additional custom validation logic can be added here
            // For example, checking unique constraints or complex validation rules
        });
    }
}
