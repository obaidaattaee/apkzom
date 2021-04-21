<?php


namespace App\Http\Controllers\Site;


use App\Http\Controllers\Controller;
use App\Models\App;
use App\Models\Category;
use App\Models\Slider;
use App\Models\Tag;
use App\User;
use Illuminate\Support\Facades\Cache;

class SiteController extends Controller
{

    public function index () {
        Cache::forget('sliders');
        Cache::forget('categories');
        Cache::forget('tags');
        Cache::forget('games');
        Cache::forget('apps');
        $sliders = Cache::remember('sliders' , 3600 ,function () {
            return Slider::where('is_active' , true)->get();
        });
        $categories = Cache::remember('categories' , 3600 ,function () {
            return Category::where('is_active' , true)->get();
        });
        $tags = Cache::remember('users' , 3600 ,function () {
            return Tag::where('is_active' , true)->get();
        });
        $users = Cache::remember('tags' , 3600 ,function () {
            return User::get()->except([1])->take(10);
        });
        $games = Cache::remember('games' , 3600 ,function () {
            return App::whereHas('category' , function ($query) {
                return $query->where('id' , Category::CATEGORIES[0]['id']);
            })->orderBy('updated_at' , 'desc')->get()->take(8);
        });
        $apps = Cache::remember('apps' , 3600 ,function () {
            return App::whereHas('category' , function ($query){
                return $query->where('id' , Category::CATEGORIES[1]['id']);
            })->orderBy('updated_at' , 'desc')->get()->take(8);
        });
        return view('welcome')
            ->with('sliders' , $sliders)
            ->with('tags' , $tags)
            ->with('users' , $users)
            ->with('games' , $games)
            ->with('apps' , $apps)
            ->with('categories' , $categories);
    }
}
