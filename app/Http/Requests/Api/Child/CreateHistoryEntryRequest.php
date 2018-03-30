<?php

namespace Dzeparac\Http\Requests\Api\Child;

use Illuminate\Foundation\Http\FormRequest;

class CreateHistoryEntryRequest extends FormRequest
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
     * TODO: Add validation rule for image size
     *
     * @return array
     */
    public function rules()
    {
    	$child = \Auth::user();

        return [
        	'category_id' => 'required|integer',
            'name' => 'required|string',
	        'price' => "required|double|min:0.01|max:{$child->money}",
	        'notes' => 'nullable|string',
	        'photo' => 'required|image',
        ];
    }
}
