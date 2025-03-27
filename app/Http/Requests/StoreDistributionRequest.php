<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDistributionRequest extends FormRequest
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
            'product_id' => 'required|exists:products,id',
            'product_number' => 'required|numeric',
            'product_label' => 'nullable|string|max:100',
            'employee_id' => 'required|exists:employees,id',
            'distribute_date' => 'required|date',
            'distribute_time' => 'nullable|date_format:H:i',
            'serial_number' => 'nullable|string|max:100',
            'location' => 'nullable|string|max:100',
            'condition' => 'nullable|string|max:50',
            'status' => 'nullable|string|max:50',
            'handed_over_by' => 'required|string|max:100',
            'received_by' => 'required|string|max:100',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240', // 10MB
            'remark' => 'nullable|string|max:1000'
        ];
    }
}
