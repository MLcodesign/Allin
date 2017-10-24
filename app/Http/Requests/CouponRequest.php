<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CouponRequest extends Request
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
        switch ($this->method()) {
            case 'GET':
            case 'DELETE': {
                return [];
            }
            case 'POST': {
                return [
                    'code' => 'required|min:6',
                    'point' => 'required',
                    'from_date' => 'required',
                    'to_date' => 'required',
                ];
            }
            case 'PUT':
            case 'PATCH': {
                return [
                    'code' => 'required|min:6',
                    'point' => 'required',
                    'from_date' => 'required',
                    'to_date' => 'required',
					'status' => 'required',
                ];
            }
            default:
                break;
        }
        return [
            //
        ];
    }
}
