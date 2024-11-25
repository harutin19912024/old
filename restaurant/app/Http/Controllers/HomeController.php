<?php

namespace App\Http\Controllers;

use App\Admin\AboutUs;
use Illuminate\Http\Request;
use App\Admin\ContactUs;
use App\Admin\ContactUsFormData;
use App\Admin\Product;
use App\Admin\Slider;
use App\Admin\Overview;
use App;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        App::setLocale('ru');
        session()->put('locale', 'ru');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $contactInfo = ContactUs::first();
        $aboutInfo = AboutUs::first();
        $products = Product::all()->where('show', '1');
        $slider = Slider::all();
        $overview = Overview::all();
        return view('home.index', compact('aboutInfo', 'contactInfo', 'products','slider','overview'));
    }

	public function about()
    {
        //return view('home');
        $aboutInfo = AboutUs::first();
        $contactInfo = ContactUs::first();
        $overview = Overview::all();
        return view('home.about',compact('aboutInfo','contactInfo','overview'));
    }
    public function blog()
    {
        //return view('home');
        return view('home.blog');
    }
    public function contact()
    {
        $contactInfo = ContactUs::first();
        return view('home.contact',compact('contactInfo'));
    }

    public function storeContactUsData(Request $request)
    {
        $request->validate([
            'subject' => 'required',
            'message' => 'required'
        ]);

        $media = new ContactUsFormData;
        $media->name = $request->name;
        $media->subject = $request->subject;
        $media->message = $request->message;
        $media->email = $request->email;
        $media->save();

        return redirect('contact');
    }

    public function elements()
    {
        $gallery = App\Admin\Media::all();
        return view('home.elements',compact('gallery'));
    }
    public function foodMenu()
    {
        $products = Product::all();
        $categories = [];
        foreach($products as $product) {
            $categories[$product->category->name][] = $product;
        }

        return view('home.food_menu',compact('products', 'categories'));
    }
//    public function menu()
//    {
//        //return view('home');
//        return view('home.menu');
//    }
    public function singleBlog()
    {
        //return view('home');
        return view('home.single_blog');
    }
}
