<?php

namespace App\Http\Requests;


use App\Http\Requests\ApiRequest;

class OrderRequest extends ApiRequest
{

    public function rules()
    {
        return [
            'pointA' => 'required|string',
            'pointB' => 'required|string',
            'price' => 'required|int',
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'pointA.required' => 'PointA required!',
            'pointB.required' => 'PointB id required!',
            'price.required' => 'Price required'
        ];
    }

}
