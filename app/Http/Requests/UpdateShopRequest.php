<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateShopRequest extends FormRequest
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
                   'theme' => 'required|string|max:100',
                   'biography' => 'required|string|max:255',
                   'specialties' => 'nullable|string|max:75',
                   'location' => 'nullable|string|max:50',
                   'techniques' => 'nullable|string|max:75',
                   'img_url' => 'nullable|string|max:255',
                   'user_id' => 'required|uuid|exists:users,id',
               ];
    }

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
            'theme.required' => 'Theme is required',
            'theme.string' => 'Theme should be a text',
            'theme.max' => 'Theme should not be more than 100 characters',
            'biography.required' => 'Biography is required',
            'biography.longText' => 'Biography should be a text',
            'biography.max' => 'Biography should not be more than 255 characters',
            'specialties.longText' => 'Specialties should be a text',
            'specialties.max' => 'Specialties should not be more than 75 characters',
            'location.string' => 'Location should be a text',
            'location.max' => 'Location should not be more than 50 characters',
            'techniques.string' => 'Techniques should be a text',
            'techniques.max' => 'Techniques should not be more than 75 characters',
            'img_url.string' => 'Image URL should be a text',
            'img_url.max' => 'Image URL should not be more than 255 characters',
            'user_id.required' => 'User ID is required',
            'user_id.uuid' => 'User ID should be a UUID',
            'user_id.exists' => 'User ID does not exist',
        ];
    }
}
