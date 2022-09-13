<?php

namespace App\Http\Requests\Version_2;

use Illuminate\Foundation\Http\FormRequest;
use PhpParser\Node\Expr\FuncCall;

class CouponRequest extends FormRequest
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
            'email' => '',
            'couponType' => 'required',
            'couponSubtype' => 'required',
            'value' => '',
            'limit' => '',
            'validUntil' => ''
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'coupon_type' => $this->couponType,
            'coupon_subtype' => $this->couponSubtype,
            'valid_until' => $this->validUntil,
            'creator_email' => $this->email
        ]);
    }
}
