<?php

namespace App\Http\Controllers;

use App\Http\Classes\Recommend;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;

class HomeController extends Base
{
    /**
     * Create a new controller instance.
     *
     * @return void
     * @throws \Exception
     */
    public function __construct()
    {
        if (!Cache::has('topGames')) {
            Cache::remember('topGames', 7200, function () {
                $products = Product::where('rate', '>=', '2')->with('category')->take(15)->get();
                if (count($products) < 2) {
                    $products = Product::inRandomOrder()->limit(15)->get();
                }
                return $this->getArray($products);
            });
        }
        if (!Cache::has('recentAdded')) {
            Cache::remember('recentAdded', 7200, function () {
                $products = Product::orderBy('id', 'desc')->take(12)->get();
                if (count($products) < 2) {
                    $products = Product::inRandomOrder()->limit(15)->get();
                }
                return $this->getArray($products);
            });
        }
        if (!Cache::has('categories')) {
            Cache::remember('categories', 7200, function () {
                return Category::where('visible', '=', '1')->get();
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
        $topRate = Cache::get('topGames');
        $recentAdded = Cache::get('recentAdded');
        $getRecommendation = $this->getRecomm();
        $randomly = $this->getArray(Product::where('rate', '<=', '2')->inRandomOrder()->with('items')->limit(4)->get());
        $lastUpdate = $this->getArray(Product::orderBy('updated_at', 'desc')->with('items')->limit(4)->get());
        return view('index', compact('topRate', 'recentAdded', 'randomly', 'lastUpdate', 'getRecommendation'));
    }
    private function getRecomm(){
        $getRecommendation = array();
        if (Auth::check()) {
            $list = array();
            $rates = \App\Models\Rate::whereRaw('1=1')->with('user')->with('product')->get();
            foreach ($rates as $rate) {
                if (array_key_exists($rate->user->id, $list)) {
                    $list[$rate->user->name][$rate->product->name] = $rate->product->rate;
                    continue;
                }
                $list[$rate->user->name][$rate->product->name] = $rate->product->rate;
            }
            $re = new Recommend();
            $forUser = $re->getRecommendations($list, Auth::user()->name);
            if($forUser == null){
                return $this->getArray(Product::where('rate', '<=', '2')->inRandomOrder()->with('items')->limit(3)->get());
            }
            if (count($forUser) < 1) {
                $getRecommendation = $this->getArray(Product::where('rate', '<=', '2')->inRandomOrder()->with('items')->limit(3)->get());
            } else {
                $forUser = array_keys($forUser);
                $tempCounter = 0;
                foreach ($forUser as $productName) {
                    if($tempCounter > 2){
                        break;
                    }
                    $product = Product::where('name', '=', str_replace(' ', '-', $productName))->with('items')->first();
                    array_push($getRecommendation, $product);
                    $tempCounter++;
                }
            }
        } else {
            $getRecommendation = $this->getArray(Product::where('rate', '<=', '2')->inRandomOrder()->with('items')->limit(3)->get());
        }
        return $getRecommendation;
    }

    public function contact()
    {
        return view('contact');
    }

    public function search(Request $request)
    {
        if(!isset($reqiest->c) && !isset($request->s)){
            return back();
        }
        if($request->c == 0){
            $products = Product::where('name','LIKE','%' . $this->validation_input(str_replace(' ', '-', $request->s)) . "%")->paginate(15);
        } else {
            $products = Product::where('category_id', $this->validation_input($request->c))->where('name','LIKE','%' . $this->validation_input(str_replace(' ', '-', $request->s)) . "%")->paginate(15);
        }
        return view('search', compact('products'));
    }

    public function sendContactMessage(Request $request)
    {
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
