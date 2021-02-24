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

class AdminController extends Base
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
        $items = Item::orderBy("id")->with('product')->with('order')->paginate(20);
        $products = Product::all();
        return view('layouts.admin.items', compact('items', 'products'));
    }

    public function viewProduct(Request $request)
    {
        $products = Product::orderBy("id")->with('items')->paginate(20);
        $categories = Category::all();
        return view('layouts.admin.products', compact('products', 'categories'));
    }

    public function viewCategories(Request $request)
    {
        $categories = Category::orderBy("id")->with('products')->paginate(20);
        return view('layouts.admin.categories', compact('categories'));
    }

    public function addCategories(Request $request)
    {
        session()->flash('fromMethod', "addCategory");
        $validated = $request->validate([
            'name' => ['bail', 'required', 'string', 'min:4', 'max:50']
        ]);
        Category::create([
            'name' => $this->validation_input($request->input('name'))
        ]);
        session()->flash('successMessage', "Item has been added");
        return redirect()->route('front.admin.viewCategory');
    }
    public function updateCategory(Request $request)
    {
        session()->flash('fromMethod', "updateCategory");
        $validated = $request->validate([
            'name' => ['bail', 'required', 'string', 'min:4', 'max:50']
        ]);
        $category = Category::find($request->input('category_id'));
        $category->name = $this->validation_input($request->input('name'));
        $category->save();
        session()->flash('successMessage', "Item has been updated");
        return redirect()->route('front.admin.viewCategory');
    }
    public function deleteCategory($id)
    {
        $category = Category::find($id);
        $category->delete();
        session()->flash('successMessage', "Item has been deleted");
        return redirect()->route('front.admin.viewCategory');
    }
    public function deleteItem($id)
    {
        $item = Item::find($id);
        $item->delete();
        session()->flash('successMessage', "Item has been deleted");
        return redirect()->route('front.admin.viewItems');
    }
    public function deleteProduct($id)
    {
        $product = Product::find($id);
        $product->delete();
        session()->flash('successMessage', "Item has been deleted");
        return redirect()->route('front.admin.viewItems');
    }

    public function addItem(Request $request)
    {
        $validated = $request->validate([
            'product' => ['bail', 'required', 'numeric'],
            'key' => ['required', 'string', 'min:6', 'max:30']
        ]);
        Item::create([
            'product_id' => $this->validation_input($request->input('product')),
            'value' => $this->validation_input($request->input('key')),
            'activated' => 0
        ]);
        session()->flash('successMessage', "Item has been added");
        return redirect()->route('front.admin.viewItems');
    }

    public function addProduct(Request $request)
    {
        $validated = $request->validate([
            'productCategory' => 'required|numeric',
            'productName' => 'required|min:8|max:255',
            'productPrice' => 'required|numeric',
            'productSale' => 'required|numeric',
            'productImage' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        $imageMain = 'img-' . time() . '.' . request()->productImage->getClientOriginalExtension();
        Product::create([
            'user_id' => Auth::id(),
            'category_id' => $this->validation_input($request->productCategory),
            'sku' => substr($request->productName, 0, 3) . "-" . rand(1, 5000),
            'name' => $this->validation_input($request->productName),
            'description' => $this->validation_input($request->productDesc),
            'price' => $request->productPrice,
            'sale' => $request->productSale,
            'image' => $imageMain,
            'rate' => 0,
            'meta' => substr($this->validation_input($request->productName), 0, 30)
        ]);
        request()->productImage->move(public_path('img/'), $imageMain);
        session()->flash('successMessage', "Product has been added");
        return redirect()->route('front.admin.viewProducts');
    }

    public function clearCache()
    {
        Cache::flush();
    }
}
