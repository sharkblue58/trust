<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\ProductsDiscountRequest;

class ProductsDiscountRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            
            'name' => ['required', 'max:255'],
            'desc' => ['required'],
          
            'discount_percent'=>['required'],
             'active' => ['required','boolean'],
      
            
        ];
    }
}
