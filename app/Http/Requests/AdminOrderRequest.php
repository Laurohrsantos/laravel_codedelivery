<?php

namespace CodeDelivery\Http\Requests;

class AdminOrderRequest extends Request
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
            'client_id' => 'required|integer',
            'user_deliveryman_id' => 'required|integer',
            'total' => 'required',
            'status' => 'required',
        ];
    }
}
