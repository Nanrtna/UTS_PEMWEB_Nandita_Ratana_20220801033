<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroysupir busRequest;
use App\Http\Requests\Storesupir busRequest;
use App\Http\Requests\Updatesupir busRequest;
use App\Models\supir bus;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class supir busController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('supir bus_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $supir buss = supir bus::with(['media'])->get();

        return view('admin.supir buss.index', compact('supir buss'));
    }

    public function create()
    {
        abort_if(Gate::denies('supir bus_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.supir buss.create');
    }

    public function store(Storesupir busRequest $request)
    {
        $supir bus = supir bus::create($request->all());

        if ($request->input('logo', false)) {
            $supir bus->addMedia(storage_path('tmp/uploads/' . basename($request->input('logo'))))->toMediaCollection('logo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $supir bus->id]);
        }

        return redirect()->route('admin.supir buss.index');
    }

    public function edit(supir bus $supir bus)
    {
        abort_if(Gate::denies('supir bus_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.supir buss.edit', compact('supir bus'));
    }

    public function update(Updatesupir busRequest $request, supir bus $supir bus)
    {
        $supir bus->update($request->all());

        if ($request->input('logo', false)) {
            if (! $supir bus->logo || $request->input('logo') !== $supir bus->logo->file_name) {
                if ($supir bus->logo) {
                    $supir bus->logo->delete();
                }
                $supir bus->addMedia(storage_path('tmp/uploads/' . basename($request->input('logo'))))->toMediaCollection('logo');
            }
        } elseif ($supir bus->logo) {
            $supir bus->logo->delete();
        }

        return redirect()->route('admin.supir buss.index');
    }

    public function show(supir bus $supir bus)
    {
        abort_if(Gate::denies('supir bus_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.supir buss.show', compact('supir bus'));
    }

    public function destroy(supir bus $supir bus)
    {
        abort_if(Gate::denies('supir bus_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $supir bus->delete();

        return back();
    }

    public function massDestroy(MassDestroysupir busRequest $request)
    {
        $supir buss = supir bus::find(request('ids'));

        foreach ($supir buss as $supir bus) {
            $supir bus->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('supir bus_create') && Gate::denies('supir bus_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new supir bus();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
