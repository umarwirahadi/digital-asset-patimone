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
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'requisition_no' => 'required|string|max:50|unique:requisitions,requisition_no,'.$this->route('id'),
            'requisition_type' => 'required|string',
            'requisition_description' => 'nullable|string|max:200',
            'requisition_file' => 'nullable|mimes:png,jpg,jpeg,pdf|max:10240',
            'requisition_date' => 'required|date',
            'requisition_remark' => 'nullable|string|max:200',
            'date_supplied_by_contractor' => 'nullable|date',
            'remark_by_contractor' => 'nullable|string|max:300',
            'date_received_by_engineer' => 'nullable|date',
            'remark_by_engineer' => 'nullable|string|max:300'
        ];
    }

    public function messages()
    {
        return [
            'requisition_no.required' => 'Requisition number is required',
            'requisition_no.string' => 'Requisition number must be a string',
            'requisition_no.max' => 'Requisition number must not be more than 50 characters',
            'requisition_no.unique' => 'Requisition number has already been taken',
            'requisition_type.required' => 'Requisition type is required',
            'requisition_type.string' => 'Requisition type must be a string',
            'requisition_description.string' => 'Requisition description must be a string',
            'requisition_description.max' => 'Requisition description must not be more than 200 characters',
            'requisition_file.mimes' => 'Requisition file must be a file of type: png, jpg, jpeg, pdf',
            'requisition_file.max' => 'Requisition file must not be more than 10MB',
            'requisition_date.required' => 'Requisition date is required',
            'requisition_date.date' => 'Requisition date must be a date',
            'requisition_remark.string' => 'Requisition remark must be a string',
            'requisition_remark.max' => 'Requisition remark must not be more than 200 characters',
            'date_supplied_by_contractor.date' => 'Date supplied by contractor must be a date',
            'remark_by_contractor.string' => 'Remark by contractor must be a string',
            'remark_by_contractor.max' => 'Remark by contractor must not be more than 300 characters',
            'date_received_by_engineer.date' => 'Date received by engineer must be a date',
            'remark_by_engineer.string' => 'Remark by engineer must be a string',
            'remark_by_engineer.max' => 'Remark by engineer must not be more than 300 characters',
            'status.required' => 'Status is required',
            'status.string' => 'Status must be a string',
            'status.max' => 'Status must not be more than 1 character'
        ];
    }
}
