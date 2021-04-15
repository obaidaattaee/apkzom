<?php


namespace App\Http\Controllers\Admin;


use App\DataTables\CategoryDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;
use \Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index')->with('categories', $categories);
    }

    public function store(StoreCategoryRequest $request)
    {
        $category = Category::create($request->all());
        $category->setTranslations('title', $request->input('title'));
        return redirect()->route('categories.index')->with('message', __('create_successfully'));
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('message', __('common.delete_successfully'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit')->with('category', $category);
    }

    public function update(StoreCategoryRequest $request, Category $category)
    {
        $category->update($request->all());
        return redirect()->route('categories.index')->with('message', __('common.update_successfully'));
    }

    public function categories()
    {
        $categories = Category::query();

        if (request()->has('category')) {
            $category = request()->input('category');
            $categories = $categories->where(function ($query) use ($category) {
                foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
                    $query->orWhere('title->'.$localeCode , "like" , "%{$category}%");
                }
                return $query;
            });
        }
        $categories = $categories->get(['id', 'title']);
        return $categories;
    }

}
