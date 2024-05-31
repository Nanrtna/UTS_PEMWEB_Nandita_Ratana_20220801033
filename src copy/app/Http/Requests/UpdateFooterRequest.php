<?php

namespace App\Http\Requests;

use App\Models\supir bus;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class Updatesupir busRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('supir bus_edit');
    }

    public function rules()
    {
        return [
            'detail' => [
                'string',
                'nullable',
            ],
            'phone' => [
                'string',
                'nullable',
            ],
            'faximile' => [
                'string',
                'nullable',
            ],
            'email' => [
                'string',
                'nullable',
            ],
        ];
    }
}
