@extends('layouts.admin')
@section('content')
@can('supir bus_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.supir buss.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.supir bus.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.supir bus.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-supir bus">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.supir bus.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.supir bus.fields.logo') }}
                        </th>
                        <th>
                            {{ trans('cruds.supir bus.fields.detail') }}
                        </th>
                        <th>
                            {{ trans('cruds.supir bus.fields.alamat') }}
                        </th>
                        <th>
                            {{ trans('cruds.supir bus.fields.phone') }}
                        </th>
                        <th>
                            {{ trans('cruds.supir bus.fields.faximile') }}
                        </th>
                        <th>
                            {{ trans('cruds.supir bus.fields.email') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($supir buss as $key => $supir bus)
                        <tr data-entry-id="{{ $supir bus->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $supir bus->id ?? '' }}
                            </td>
                            <td>
                                @if($supir bus->logo)
                                    <a href="{{ $supir bus->logo->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $supir bus->logo->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                            <td>
                                {{ $supir bus->detail ?? '' }}
                            </td>
                            <td>
                                {{ $supir bus->alamat ?? '' }}
                            </td>
                            <td>
                                {{ $supir bus->phone ?? '' }}
                            </td>
                            <td>
                                {{ $supir bus->faximile ?? '' }}
                            </td>
                            <td>
                                {{ $supir bus->email ?? '' }}
                            </td>
                            <td>
                                @can('supir bus_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.supir buss.show', $supir bus->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('supir bus_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.supir buss.edit', $supir bus->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('supir bus_delete')
                                    <form action="{{ route('admin.supir buss.destroy', $supir bus->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('supir bus_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.supir buss.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-supir bus:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection