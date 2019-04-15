<?php

namespace App\Http\Requests\Admin\Category;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|exists:categories,slug,id,'.$this->category->id,
            'parent' => 'nullable|integer|exists:categories,id,'.$this->category->id,
            'image' => 'nullable|image|mimes:jpg,jpeg,png',
            'icon' => 'nullable|image|mimes:jpg,jpeg,png',


//            'slug' => 'required|string|max:255|'.Rule::unique('categories', 'slug')->ignore($this->category->id),
//            'parent' => 'nullable|integer|'. Rule::unique('categories', 'id')->ignore($this->category->id),
        ];
    }
}
