@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.supir bus.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.supir buss.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.supir bus.fields.id') }}
                        </th>
                        <td>
                            {{ $supir bus->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supir bus.fields.logo') }}
                        </th>
                        <td>
                            @if($supir bus->logo)
                                <a href="{{ $supir bus->logo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $supir bus->logo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supir bus.fields.detail') }}
                        </th>
                        <td>
                            {{ $supir bus->detail }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supir bus.fields.alamat') }}
                        </th>
                        <td>
                            {{ $supir bus->alamat }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supir bus.fields.phone') }}
                        </th>
                        <td>
                            {{ $supir bus->phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supir bus.fields.faximile') }}
                        </th>
                        <td>
                            {{ $supir bus->faximile }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supir bus.fields.email') }}
                        </th>
                        <td>
                            {{ $supir bus->email }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.supir buss.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection