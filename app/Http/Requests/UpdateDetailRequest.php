<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDetailRequest extends FormRequest
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
            'description_item' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'preferred_brand' => 'nullable|string|max:50',
            'unit' => 'required|string|max:20',
            'quantity' => 'required|numeric|min:1',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public function messages()
    {
        return [            
            'request_id.exists' => 'The selected requisition ID is invalid.',
            'description_item.required' => 'The description item is required.',
            'category.required' => 'The category is required.',
            'preferred_brand.required' => 'The preferred brand is required.',
            'unit.required' => 'The unit is required.',
            'quantity.required' => 'The quantity is required.',
            'photo.image' => 'The photo must be an image.',
            'photo.mimes' => 'The photo must be a file of type: jpeg, png, jpg, gif.',
            'photo.max' => 'The photo may not be greater than 2048 kilobytes.',
        ];
    }
}
