<?php


namespace App\Http\Controllers\Admin;


use App\DataTables\AppDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAppRequest;
use App\Models\App;
use App\Models\AppParts;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use \Intervention\Image\Facades\Image;

class AppController extends Controller
{

    public function index(AppDataTable $dataTable)
    {
        return $dataTable->render('admin.apps.index');
    }

    public function create():View
    {
        return view('admin.apps.create');
    }

    public function store(StoreAppRequest $request)
    {
        $imagePath = App::APP_LOGO_PATH;
        try {
            $file = $request->file('logoFile');
            $fileName = Storage::disk('uploads')->put(basename($file), $file);
            $file = Image::make($file)->resize(100 , 100)->encode('jpg');
            $logo = $request->input('on_server') ?
                Storage::disk('uploads')->put($imagePath . '/' . $fileName, $file) :
                Storage::disk('b2')->put('uploads/' . $imagePath . '/' . $fileName, $file);
            $request->merge(['image' => $fileName]);
        } catch (\Exception $exception) {
            return redirect()->back()->with('message', __('common.cannot_upload_file'));
        }
        $request['on_server'] = $request['on_server'] ? true : false;
        $app = App::create($request->only([
            'extension' , 'published_at' , 'owner_id' , 'category_id' , 'os_type_id' , 'os_version_id' , 'on_server' , 'image'
        ]));
        foreach ($request->input('app') as $locale => $translation){
            $app->translations()->create([
                'locale' => $locale,
                'title' => $translation['title'],
                'description' => $translation['description'],
            ]);
        }
        $app->tags()->sync($request->input('tags'));
        return redirect()->route('apps.show' , ['app' => $app->id])->with('message' , __('common.create_successfully'));
    }

    public function destroy(App $app){
        $app->delete();
        return redirect()->route('apps.index')->with('message' , __('common.delete_successfully'));
    }

    public function show(App $app)
    {
        return view('admin.apps.show')->with('app' , $app);
    }
}
