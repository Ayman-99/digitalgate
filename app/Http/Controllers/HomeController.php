<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     * @throws \Exception
     */
    public function __construct()
    {
        //cache()->flush();
        if(!Cache::has('categories')){
            Cache::rememberForever('categories', function () {
                return Category::all();
            });
        }
        if(!Cache::has('topGames')){
            Cache::remember('topGames',7200, function () {
                return Product::where('rate','>=','4')->with('category')->take(6)->get();
            });
        }
        if(!Cache::has('recentAdded')){
            Cache::remember('recentAdded',7200, function () {
                return Product::orderBy('id', 'desc')->take(8)->get();
            });
        }
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('index');
    }

    public function contact(){
        return view('contact');
    }

    public function sendContactMessage(Request $request){
        $temp = "Name: " . $request->contactName . "\n";
        $temp .= "Email: " . $request->contactEmail . "\n";
        $temp .= "Subject: " . $request->contactSubject . "\n";
        $temp .= "Text: " . $request->contactText;

        Mail::raw($temp, function ($message) {
            $message
                ->to('aymanhun@gmail.com', 'Ayman')
                ->subject('Contact notification');
        });
        return back()->with('success', 'Message has been sent');
    }

}
