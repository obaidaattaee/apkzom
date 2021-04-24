<?php


namespace App\Http\Controllers\Site;


use App\Http\Controllers\Controller;
use App\Models\App;
use App\Models\Category;
use App\Models\Slider;
use App\Models\Tag;
use App\Models\Vendor;
use App\User;
use Illuminate\Support\Facades\Cache;

class SiteController extends Controller
{

    public function index () {
        Cache::forget('sliders');

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
}
