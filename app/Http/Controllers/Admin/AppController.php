<?php


namespace App\Http\Controllers\Admin;


use App\DataTables\AppDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAppRequest;
use App\Models\App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Intervention\Image\Facades\Image;

class AppController extends Controller
{


    public function index(AppDataTable $dataTable)
    {
        return $dataTable->render('admin.apps.index');
    }

    public function create(): View
    {
        return view('admin.apps.create');
    }

    public function store(StoreAppRequest $request)
    {
        $imagePath = App::APP_LOGO_PATH;
        try {
            $file = $request->file('logoFile');
            $fileName = Storage::disk('uploads')->put(basename($file), $file);
            $file = Image::make($file)->resize(160, 160)->encode('jpg');
            $logo = $request->input('on_server') ?
                Storage::disk('uploads')->put($imagePath . '/' . $fileName, $file) :
                Storage::disk('b2')->put('uploads/' . $imagePath . '/' . $fileName, $file);
            $request->merge(['image' => $fileName]);
        } catch (\Exception $exception) {
            return redirect()->back()->with('message', __('common.cannot_upload_file'));
        }
        $request['on_server'] = $request['on_server'] ? true : false;
        $app = App::create($request->only([
            'extension', 'rate', 'published_at', 'owner_id', 'category_id', 'os_type_id', 'os_version_id', 'on_server', 'image'
        ]));
        foreach ($request->input('app') as $locale => $translation) {
            $app->translations()->create([
                'locale' => $locale,
                'title' => $translation['title'],
                'description' => $translation['description'],
            ]);
        }
        $app->versions()->create($request->input('version'));
        $app->tags()->sync($request->input('tags'));
        return redirect()->route('apps.show', ['app' => $app->id])->with('message', __('common.create_successfully'));
    }

    public function destroy(App $app)
    {
        $app->delete();
        return redirect()->route('apps.index')->with('message', __('common.delete_successfully'));
    }

    public function show(App $app)
    {
        $app->load(['versions' , 'images']);
        return view('admin.apps.show')->with('app', $app);
    }

    public function edit(App $app)
    {
        return view('admin.apps.edit')->with('app', $app);
    }


    public function update(App $app, StoreAppRequest $request)
    {
        $imagePath = App::APP_LOGO_PATH;
        if ($request->has('logoFile')) {
            try {
                $file = $request->file('logoFile');
                $fileName = Storage::disk('uploads')->put(basename($file), $file);
                $file = Image::make($file)->resize(160, 160)->encode('jpg');
                $logo = $request->input('on_server') ?
                    Storage::disk('uploads')->put($imagePath . '/' . $fileName, $file) :
                    Storage::disk('b2')->put('uploads/' . $imagePath . '/' . $fileName, $file);
                $request->merge(['image' => $fileName]);
                $request['on_server'] = $request['on_server'] ? true : false;
            } catch (\Exception $exception) {
                return redirect()->back()->with('message', __('common.cannot_upload_file'));
            }
        } else {
            $request['on_server'] = $app->on_server;
            $request['image'] = $app->image;
        }

        $app->update($request->only([
            'extension', 'rate', 'published_at', 'owner_id', 'category_id', 'os_type_id', 'os_version_id', 'on_server', 'image'
        ]));
        foreach ($request->input('app') as $locale => $translation) {
            $trans = $app->translations()->where('locale', $locale);
            $trans->update($translation);
        }
        $app->tags()->sync($request->input('tags'));
        return redirect()->route('apps.show', ['app' => $app->id])->with('message', __('common.create_successfully'));
    }


    public function apps(Request $request)
    {
        $apps = App::query();
        if ($request->has('title')) {
            $apps = $apps->whereHas('translations', function ($translation) use ($request) {
                return $translation->where('title', 'like', "%{$request->input('title')}%");
            });
        }
        $apps = $apps->limit(4)->get();
        return $apps;
    }
}
