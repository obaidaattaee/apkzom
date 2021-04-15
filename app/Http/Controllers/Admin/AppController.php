<?php


namespace App\Http\Controllers\Admin;


use App\DataTables\AppDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAppRequest;
use App\Models\App;
use App\Models\AppParts;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

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
        $app = App::create($request->except(['parts' , 'images' , 'tags']));
        $app->tags()->sync($request->input('tags'));
        if ($request->has('images')){
            foreach ($request->images as $key => $imageFile){
                $image = Storage::disk('uploads')->put(basename($imageFile) , $imageFile);
                $app->images()->create(['path' => $image]);
            }
        }
        if ($request->has('parts')){
            foreach ($request->parts as $key => $part){
                $part['part_number'] = $key;
                $appPart = $app->parts()->create($part);
            }
        }
        return redirect()->route('apps.index')->with('message' , __('common.create_successfully'));
    }

    public function destroy(App $app){
        $app->delete();
        return redirect()->route('apps.index')->with('message' , __('common.delete_successfully'));
    }

}
