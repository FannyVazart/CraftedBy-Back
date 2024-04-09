<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;


class StoreProductRequest extends FormRequest
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
            'name' => 'required|string|max:50|min:4',
            'description' => 'required|string|max:100',
            'price' => 'required|integer',
            'quantity' => 'nullable|integer',
            'material' => 'nullable|string|max:50',
            'color' => 'nullable|string|max:50',
            'size' => 'nullable|string|max:20',
            'category' => 'nullable|string|max:50',
            'img_url' => 'nullable|string|max:255',
            'shop_id' => 'required|uuid|exists:shops,id',
        ];
    }

    /**
     * Handle a failed validation attempt.
     */
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Validation errors',
            'data' => $validator->errors()
        ]));
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages()
    {
        return [
            'name.required' => 'Name is required',
            'name.string' => 'Name should be a text',
            'name.max' => 'Name should not be more than 50 characters',
            'name.min' => 'Name should not be less than 4 characters',
            'description.required' => 'Description is required',
            'description.string' => 'Description should be a text',
            'description.max' => 'Description should not be more than 100 characters',
            'price.required' => 'Price is required',
            'price.integer' => 'Price should be a number',
            'quantity.integer' => 'Quantity should be a number',
            'material.string' => 'Material should be a text',
            'material.max' => 'Material should not be more than 50 characters',
            'color.string' => 'Color should be a text',
            'color.max' => 'Color should not be more than 50 characters',
            'size.string' => 'Size should be a text',
            'size.max' => 'Size should not be more than 20 characters',
            'category.string' => 'Category should be a text',
            'category.max' => 'Category should not be more than 50 characters',
            'img_url.string' => 'Image URL should be a text',
            'img_url.max' => 'Image URL should not be more than 255 characters',
            'shop_id.required' => 'Shop ID is required',
            'shop_id.uuid' => 'Shop ID should be a valid UUID',
            'shop_id.exists' => 'Shop ID does not exist'
        ];
    }

}


