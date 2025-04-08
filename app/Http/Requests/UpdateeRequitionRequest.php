<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateeRequitionRequest extends FormRequest
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
            'requisition_no' => 'required|string|max:50',
            'requisition_type' => 'required|string',
            'requisition_description' => 'nullable|string|max:200',
            'requisition_file' => 'nullable|mimes:png,jpg,jpeg,pdf|max:10240',
            'requisition_date' => 'required|date',
            'requisition_remark' => 'nullable|string|max:200',
            'date_supplied_by_contractor' => 'nullable|date',
            'remark_by_contractor' => 'nullable|string|max:300',
            'date_received_by_engineer' => 'nullable|date',
            'remark_by_engineer' => 'nullable|string|max:300',
            'status' => 'required|string|max:1',
        ];
    }

    public function messages()
    {
        return [
            'requisition_no.required' => 'Requisition No is required',
            'requisition_no.string' => 'Requisition No must be a string.',
            'requisition_no.max' => 'Requisition No must not exceed 50 characters.',
            'requisition_description.string' => 'Requisition Description must be a string.',
            'requisition_description.max' => 'Requisition Description must not exceed 200 characters.',
            'requisition_type.required' => 'type of requisition  is required',
            'requisition_type.string' => 'Requisition Type must be a string.',
            'requisition_file.mimes' => 'File must be a file of type: png, jpg, jpeg, pdf.',
            'requisition_file.max' => 'File size must not exceed 10MB.',
            'requisition_date.required' => 'Requisition Date is required',
            'status.required' => 'Status is required',
            'requisition_remark.max' => 'Requisition Remark must not exceed 200 characters.',
            'remark_by_contractor.max' => 'Remark by Contractor must not exceed 300 characters.',
            'remark_by_engineer.max' => 'Remark by Engineer must not exceed 300 characters.',
            'requisition_time.required' => 'Requisition Time is required',
            'requisition_location.string' => 'Requisition Location must be a string.',
            'requisition_location.max' => 'Requisition Location must not exceed 255 characters.',
            'requisition_priority.required' => 'Requisition Priority is required',
        ];
    }
}
