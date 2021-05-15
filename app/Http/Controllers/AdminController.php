<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use App\Models\Order;
use App\Models\Product;
use App\Models\Rate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class AdminController extends AdminActions
{

    public function __construct()
    {
    }

    public function viewUsers(Request $request)
    {
        $users = User::orderBy("id")->get();
        return view('layouts.admin.users', compact('users'));
    }

    public function viewOrders(Request $request)
    {
        $orders = Order::orderBy("created_at")->with('items')->get();
        return view('layouts.admin.orders', compact('orders'));
    }

    public function viewItem(Request $request)
    {
        switch (strtolower($request->method())) {
            case "get":
                $items = Item::orderBy("id")->with('product')->with('order')->get();
                $products = Product::all();
                return view('layouts.admin.items', compact('items', 'products'));
            case "post":
                return $this->addItem($request);
            case "delete":
                return $this->deleteItem($request);
        }

    }

    public function viewProduct(Request $request)
    {
        switch (strtolower($request->method())) {
            case "get":
                $products = Product::orderBy("id")->with('items')->get();
                return view('layouts.admin.products', compact('products'));
            case "post":
                return $this->addProduct($request);
            case "put":
                return $this->updateProduct($request);
            case "delete":
                return $this->deleteProduct($request);
        }

    }

    public function viewCategories(Request $request)
    {
        switch (strtolower($request->method())) {
            case "get":
                $categories = Category::orderBy("id")->with('products')->get();
                return view('layouts.admin.categories', compact('categories'));
            case "post":
                return $this->addCategory($request);
            case "delete":
                return $this->deleteCategory($request);
            case "put":
                return $this->updateCategory($request);
        }
    }

    public function disableSale(Request $request){
        $category = Category::where('id','=',$request->id)->first();
        $category->sale = 0;
        $category->sale_value = 1;
        $category->save();
        session()->flash('successMessage', "Category has been updated");
        return back();
    }

    public function enableSale(Request $request){
        $category = Category::where('id','=',$request->id)->first();
        $category->sale = 1;
        $category->sale_value = $request->val;
        $category->save();
        session()->flash('successMessage', "Category has been updated");
        return back();
    }

    public function restoreItems(Request $request)
    {
        switch (strtolower($request->method())) {    //1- Product 2- Item 3- Category
            case "get":
                $items = Item::onlyTrashed()->with('product')->with('order')->get();
                return view('layouts.admin.restoreItems', compact('items'));
            case "post":
                return $this->restoreObject($request, 2);
        }

    }

    public function restoreProducts(Request $request)
    {
        switch (strtolower($request->method())) { //1- Product 2- Item 3- Category
            case "get":
                $products = Product::onlyTrashed()->with('items')->get();
                return view('layouts.admin.restoreProducts', compact('products'));
            case "post":
                return $this->restoreObject($request, 1);
        }

    }

    public function clearCache()
    {
        Cache::flush();
        return back();
    }

    public function processRate(Request $request)
    {
        $products = Product::all();
        foreach ($products as $product){
            $rates = Rate::where('product_id', $product->id)->get();
            $star1 = $star2 = $star3 = $star4 = $star5 = 0;
            foreach ($rates as $rate){
                switch($rate->value){
                    case 1:
                        $star1++;
                        break;
                    case 2:
                        $star2++;
                        break;
                    case 3:
                        $star3++;
                        break;
                    case 4:
                        $star4++;
                        break;
                    case 5:
                        $star5++;
                        break;
                }
            }
            if(($star1+$star2+$star3+$star4+$star5) !== 0){
                $product->rate = ceil(($star1 * 1 + $star2 * 2 + $star3 * 3 + $star4 * 4 + $star5 * 5) / ($star1+$star2+$star3+$star4+$star5));
                $product->save();
            }
        }
        return back();
    }
}
