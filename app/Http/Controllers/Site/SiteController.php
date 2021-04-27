<?php


namespace App\Http\Controllers\Site;


use App\Http\Controllers\Controller;
use App\Models\App;
use App\Models\Category;
use App\Models\Slider;
use App\Models\Tag;
use App\Models\Vendor;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SiteController extends Controller
{

    public function index () {
        Cache::forget('sliders');
        Cache::forget('tags');
        Cache::forget('categories');
        // Cache::forget('sliders');

        $sliders = Cache::remember('sliders' , 3600 ,function () {
            return Slider::where('is_active' , true)->get();
        });
        return view('welcome')
            ->with('sliders' , $sliders);
    }

    public function download(App $app)
    {
        $app->load(['translations' , 'versions']);
        return view('site.download')->with('app' , $app);
    }

    public function search(Request $request){
        $apps = App::query();
        if($request->has('ci')){
            $apps = $apps->where('category_id' , $request->input('ci'));
        }if($request->has('vi')){
            $apps = $apps->where('owner_id' , $request->input('vi'));
        }if ($request->has('ti')) {
            $apps = $apps->with(['tags'])->orWhereHas('tags' , function($tag) use($request){
                return $tag->whereIn('tag_id' , $request->input('ti'));
            });
        }if ($request->has('sort')) {
            if (similar_text($request->input('sort') , __('search.download') ) > 3) {
                $apps = $apps->orderBy('download_counter' , 'desc');
            }if (similar_text($request->input('sort') , __('search.rating') ) > 3) {
                $apps = $apps->orderBy('rate' , 'desc');
            }if (similar_text($request->input('sort') , __('search.arical') ) > 3) {
                $apps = $apps->orderBy('created_at', 'desc');
            }
        }
        $apps = $apps->paginate(40);
        return view('site.search')->with('apps' , $apps);
    }

    public function details(App $app)
    {
        return view('site.app_details')->with('app' , $app);
    }
}
