<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use App\Models\Blog;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Pin;
use App\Models\Product;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{

    public function index()
    {
        $visits = Cache::get('site_visits', 0);
        Cache::put('site_visits', $visits + 1, 86400);

        $featuredProducts = Cache::remember('featured_products', 3600, function () {
            return Product::where('is_active', true)
                ->take(8)
                ->get();
        });

        $latestBlogs = Cache::remember('latest_blogs', 3600, function () {
            return Blog::where('is_published', true)
            ->latest()
            ->take(6)
            ->get();
        });


         return view('main.pages.home', compact('featuredProducts', 'latestBlogs', 'visits'));
    }

    public function about()
    {
        return view('main.pages.about');
    }

    public function category(Category $category)
    {
        $categories = $this->HeaderCategories();
        $category->load(['children.children']);

        $categoryIds = $this->getAllCategoryIds($category);


        $products = Product::whereIn('category_id', $categoryIds)->get();

        return view('main.pages.category', compact('category', 'products', 'categories'));
    }


    public function product(Product $product)
    {
        $categoryIds = [$product->category_id];
        if ($product->category->parent_id) {
            $categoryIds[] = $product->category->parent_id;
        }

        $relatedProducts = Product::whereIn('category_id', $categoryIds)
            ->where('id', '!=', $product->id)
            ->take(8)
            ->get();
        Log::info('Product viewed', ['product_id' => $product->id, 'title' => $product->title]);
        return view('main.pages.product', compact('product', 'relatedProducts'));
    }

    public function products(Request $request)
    {
        $query = Product::query()->where('is_active', true);

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        if ($request->filled('search')) {
            $query->where('title', 'like', "%{$request->search}%");
        }

        $products = $query->orderBy('created_at', 'desc')->paginate(12)->withQueryString();
        $categories = Category::with('children')->whereNull('parent_id')->get();

        return view('main.pages.products', compact('products', 'categories'));
    }



    private function HeaderCategories()
    {
        return  Category::with('children.children')->whereNull('parent_id')->get();
    }

    private function getAllCategoryIds(Category $category)
    {
        $ids = collect([$category->id]);

        foreach ($category->children as $child) {
            $ids = $ids->merge($this->getAllCategoryIds($child));
        }

        return $ids;
    }

    public function blogs(Request $request)
    {
        $query = Blog::with('archive', 'pins', 'author')
            ->where('is_published', true)
            ->latest();

        if ($request->filled('archive')) {
            $query->whereHas('archive', function ($q) use ($request) {
                $q->where('slug', $request->archive);
            });
        }

        if ($request->filled('pin')) {
            $query->whereHas('pins', function ($q) use ($request) {
                $q->where('slug', $request->pin);
            });
        }

        $blogs = $query->paginate(9);
        $archives = Archive::all();
        $pins = Pin::all();

        return view('main.pages.blogs', compact('blogs', 'archives', 'pins'));
    }


    public function blog($slug)
    {
        try {
            $blog = Blog::with('archive', 'pins', 'author')
                ->where('slug', $slug)
                ->where('is_published', true)
                ->firstOrFail();

            $relatedBlogs = Blog::where('archive_id', $blog->archive_id)
                ->where('id', '!=', $blog->id)
                ->where('is_published', true)
                ->latest()
                ->take(3)
                ->get();

            return view('main.pages.blog', compact('blog', 'relatedBlogs'));
        } catch (\Exception $e) {
            Log::error('Error loading blog', ['slug' => $slug, 'message' => $e->getMessage()]);
            return redirect()->route('home')->withErrors('بلاگ یافت نشد');
        }
    }
}
