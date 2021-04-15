<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();
        return view('admin.sliders.index')->with('sliders' , $sliders);
    }

    public function store(Request $request){
        request()->validate([
            'image' => ['required'  , 'image']
        ]);
        try {
            $file = $request->file('image');
            $logo = $request->has('image') ? Storage::disk('uploads')->put(basename($file), $file) : "";
            $request->merge(['image' => $logo]);
        } catch (\Exception $exception) {
            return redirect()->back()->with('message', __('common.cannot_upload_file'));
        }
        $slider = Slider::create([
            'image' => $request->input('image'),
            'created_by' => auth()->id()
        ]);
        return redirect()->route('sliders.index')->with('message' , __('common.create_successfully'));
    }

    public function update(Slider $slider , Request $request){
        try {
            $file = $request->file('image');
            $logo = $request->has('image') ? Storage::disk('uploads')->put(basename($file), $file) : $slider->image;
            $request->merge(['image' => $logo]);
        } catch (\Exception $exception) {
            return redirect()->back()->with('message', __('common.cannot_upload_file'));
        }
        $slider->update([
            'image' => $request->input('image'),
            'is_active' => $request->input('is_active')
        ]);
        return redirect()->route('sliders.index')->with('message' , __('common.update_successfully'));
    }

    public function destroy(Slider $slider){
        $slider->delete();
        return redirect()->route('sliders.index')->with('message' , __('common.delete_successfully'));
    }
}
