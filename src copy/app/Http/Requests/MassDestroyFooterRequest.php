<?php

namespace App\Http\Requests;

use App\Models\supir bus;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroysupir busRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('supir bus_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:supir buss,id',
        ];
    }
}
