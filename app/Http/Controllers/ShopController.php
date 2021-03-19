<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ShopController extends Base
{

    public function __construct()
    {
        if (!Cache::has('categories')) {
            Cache::remember('categories', 7200, function () {
                return Category::all();
            });
        }
    }

    public function index(Request $request)
    {
        //return $request->all();
        $sql = "";
        if ($request->has('category')) {
            $cat = $this->validation_input($request->category);
            if (is_numeric($cat) && $cat != 0) {
                $sql .= "category_id=" . $cat . " and ";
            }
        }
        if ($request->has('minPrice') && $request->has('maxPrice') && (int)$request->maxPrice !== 0 && (int)$request->minPrice !== 0) {
            $sql .= " price between " . $this->validation_input($request->minPrice) . " and " . $this->validation_input($request->maxPrice) . " and ";
        }
        if ($request->has('sort')) {
            $sql .= " deleted_at is null";
            if ($request->sort == 0) {
                $products = Product::whereRaw($sql)->orderBy('id', 'desc')->paginate(15);
            } else if ($request->sort == 1) {
                $products = Product::whereRaw($sql)->orderBy('id', 'asc')->paginate(15);
            }
        } else if ($request->has('minPrice') || $request->has('maxPrice') || $request->has('category')) {
            $sql .= " deleted_at is null";
            $products = Product::whereRaw($sql)->paginate(15);
        } else {
            $products = Product::inRandomOrder()->paginate(15);
        }
        return view('catalog', compact(['products']));
    }

    public function product(Request $request, $product)
    {
        $product = Product::where('name', $product)->with('category')->firstOrFail();
        return view('product', compact('product'));
    }

    public function cart(Request $request)
    {
        $cart = Cart::instance('shopping');
        $product = Product::find($request->p_id);
        if (is_null($product)) {
            return response(array(
                'success' => false,
                'message' => 'Error!'
            ), 417, []);
        }
        if ($product->sale === 0) {
            $price = $product->price;
        } else {
            $price = $product->sale;
        }
        switch (strtolower($request->method())) {
            case "post":
                if ($this->in_cart($product->id)) {
                    return response(array(
                        'success' => true,
                        'message' => 'Product is in cart already!',
                        'status' => 'errorInCart'
                    ), 200, []);
                } else {
                    $cartitem = $cart->add($product->id, $product->name, 1, $price);
                    $cart->associate($cartitem->rowId, 'App\Models\Product');
                    return response(array(
                        'success' => true,
                        'message' => 'Added to cart!',
                        'p_price' => $price
                    ), 200, []);
                }
            case "delete":
                if ($this->in_cart($product->id)) {
                    foreach ($cart->content() as $row) {
                        if ($row->id == $request->p_id) {
                            $cart->remove($row->rowId);
                            return response(array(
                                'success' => true,
                                'message' => 'Product has been removed from cart!',
                                'p_price' => $price
                            ), 200, []);
                        }
                    }
                }
                return $this->deleteItem($request);
        }
    }

    public function in_cart($p_id)
    {
        $cart = Cart::instance('shopping');
        $flag = false;
        foreach ($cart->content() as $item) {
            if ($item->id == $p_id) {
                $flag = true;
                break;
            }
        }
        return $flag;
    }
}
