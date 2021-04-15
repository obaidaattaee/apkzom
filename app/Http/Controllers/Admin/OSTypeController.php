<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOSTypeRequest;
use App\Models\OSType;
use Illuminate\Support\Facades\Storage;

class OSTypeController extends Controller
{
    public function index()
    {
        $osTypes = OSType::all();
        return view('admin.os_types.index')->with('osTypes', $osTypes);
    }

    public function create()
    {
        return view('admin.os_types.create');
    }

    public function store(StoreOSTypeRequest $request)
    {
        try {
            $file = $request->file('logoFile');
            $logo = $request->has('logoFile') ? Storage::disk('uploads')->put(basename($file), $file) : "";
            $request->merge(['logo' => $logo]);
        } catch (\Exception $exception) {
            return redirect()->back()->with('message', __('common.cannot_upload_file'));
        }
        OSType::create($request->only(['title', 'logo']));
        return redirect()->route('os-types.index')->with('message', __('common.created_successfully'));
    }


    public function destroy(OSType $type)
    {
        $type->delete();
        return redirect()->route('os_types.index')->with('message', __('common.delete_successfully'));
    }

    public function edit(OSType $osType)
    {
        return view('admin.os_types.edit')->with('type', $osType);
    }

    public function update(StoreOSTypeRequest $request, OSType $osType)
    {
        try {
            $file = $request->file('logoFile');
            $logo = $request->has('logoFile') ? Storage::disk('uploads')->put(basename($file), $file) : "";
            $request->merge(['logo' => $logo]);
        } catch (\Exception $exception) {
            return redirect()->back()->with('message', __('common.cannot_upload_file'));
        }

        $osType->update($request->except('logoFile'));
        return redirect()->route('os-types.index')->with('message', __('common.update_successfully'));
    }

    public function search()
    {
        $types = OSType::query();
        if (request()->has('type')) {
            $search = request()->input('type');
            $types = $types->where(function ($query) use ($search) {
                foreach (\Mcamara\LaravelLocalization\Facades\LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
                    $query->orWhere('title->' . $localeCode, "like", "%{$search}%");
                }
                return $query;
            });
        }
        $types = $types->get(['id' ,'title']);
        return \response()->json(json_decode($types));
    }
}
