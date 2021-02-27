<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use App\Models\Order;
use App\Models\Product;
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
        $users = User::orderBy("id")->paginate(20);
        return view('layouts.admin.users', compact('users'));
    }

    public function viewOrders(Request $request)
    {
        $orders = Order::orderBy("created_at")->with('items')->paginate(20);
        return view('layouts.admin.orders', compact('orders'));
    }

    public function viewItem(Request $request)
    {
        switch (strtolower($request->method())) {
            case "get":
                $items = Item::orderBy("id")->with('product')->with('order')->paginate(20);
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
                $products = Product::orderBy("id")->with('items')->paginate(20);
                $categories = Category::all();
                return view('layouts.admin.products', compact('products', 'categories'));
            case "post":
                return $this->addProduct($request);
            case "delete":
                return $this->deleteProduct($request);
        }

    }

    public function viewCategories(Request $request)
    {
        switch (strtolower($request->method())) {
            case "get":
                $categories = Category::orderBy("id")->with('products')->paginate(20);
                return view('layouts.admin.categories', compact('categories'));
            case "post":
                return $this->addCategory($request);
            case "delete":
                return $this->deleteCategory($request);
            case "put":
                return $this->updateCategory($request);
        }
    }

    public function restoreItems(Request $request)
    {
        switch (strtolower($request->method())) {    //1- Product 2- Item 3- Category
            case "get":
                $items = Item::onlyTrashed()->with('product')->with('order')->paginate(20);
                return view('layouts.admin.restoreItems', compact('items'));
            case "post":
                return $this->restoreObject($request, 2);
            case "delete":
                return $this->forceDeleteObject($request, 2);
        }

    }

    public function restoreProducts(Request $request)
    {
        switch (strtolower($request->method())) { //1- Product 2- Item 3- Category
            case "get":
                $products = Product::onlyTrashed()->with('items')->paginate(20);
                return view('layouts.admin.restoreProducts', compact('products'));
            case "post":
                return $this->restoreObject($request, 1);
            case "delete":
                return $this->forceDeleteObject($request, 1);
        }

    }

    public function restoreCategories(Request $request)
    {
        switch (strtolower($request->method())) { //1- Product 2- Item 3- Category
            case "get":
                $categories = Category::onlyTrashed()->with('products')->paginate(20);
                return view('layouts.admin.restoreCategories', compact('categories'));
            case "post":
                return $this->restoreObject($request, 3);
            case "delete":
                return $this->forceDeleteObject($request, 3);
        }

    }

    public function clearCache()
    {
        Cache::flush();
    }
}
