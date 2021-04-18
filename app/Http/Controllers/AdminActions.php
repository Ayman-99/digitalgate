<?php


namespace App\Http\Controllers;


use App\Models\Category;
use App\Models\Item;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminActions extends base
{
    protected function addCategory(Request $request)
    {
        session()->flash('fromMethod', "addCategory");
        $validated = $request->validate([
            'name' => ['bail', 'required', 'string', 'min:4', 'max:50']
        ]);
        Category::create([
            'name' => $this->validation_input($request->input('name')),
            'visible' => $request->input('categoryVisible')
        ]);
        session()->flash('successMessage', "Category has been added");
        return redirect()->route('front.admin.categories');
    }

    protected function updateCategory(Request $request)
    {
        session()->flash('fromMethod', "updateCategory");
        $validated = $request->validate([
            'name' => ['bail', 'required', 'string', 'min:4', 'max:50']
        ]);
        $category = Category::find($request->input('category_id'));
        $category->name = $this->validation_input($request->input('name'));
        $category->visible = $this->validation_input($request->input('categoryVisible'));
        $category->save();
        session()->flash('successMessage', "Category has been updated");
        return redirect()->route('front.admin.categories');
    }

    protected function deleteCategory(Request $request)
    {
        $category = Category::find($request->id);
        $cont = count($category->products()->get());
        foreach($category->products()->get() as $product){
            $product->category_id = 0;
            $product->save();
        }
        $category->delete();
        session()->flash('successMessage', "Category has been deleted and " . $cont . " products have been deleted");
        return redirect()->route('front.admin.categories');
    }

    protected function deleteItem(Request $request)
    {
        $item = Item::find($request->id);
        $item->delete();
        session()->flash('successMessage', "Item has been deleted");
        return redirect()->route('front.admin.items');
    }

    protected function deleteProduct(Request $request)
    {
        $product = Product::where('id',$request->id)->with('items')->first();
        $removedItems = 0;
        $excludedItems = 0;
        if($product->items()->exists()){
            foreach ($product->items as $item){
                if($item->activated == 0){
                    $item->delete();
                    $removedItems++;
                } else {
                    $excludedItems++;
                }
            }
        }
        $product->delete();
        session()->flash('successMessage', "Product has been deleted | $removedItems (Keys Removed) | $excludedItems (Keys excluded)");
        return redirect()->route('front.admin.products');
    }

    protected function addItem(Request $request)
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
        return redirect()->route('front.admin.items');
    }

    protected function addProduct(Request $request)
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
        request()->productImage->move(public_path('img/product/'), $imageMain);
        session()->flash('successMessage', "Product has been added");
        return redirect()->route('front.admin.products');
    }

    protected function restoreObject(Request $request, $type)
    {
        switch ($type) {
            case 1:
                $product = Product::onlyTrashed()->where('id', $request->id)->first();
                $counter = 0;
                foreach(Item::onlyTrashed()->where('product_id', $product->id)->get() as $item){
                    $item->restore();
                    $counter++;
                }
                $product->restore();
                session()->flash('successMessage', "Product has been restored and $counter serial keys were restored");
                return redirect()->route('front.admin.restoreProducts');
            case 2:
                Item::onlyTrashed()->where('id', $request->id)->restore();
                session()->flash('successMessage', "Item has been restored");
                return redirect()->route('front.admin.restoreItems');
        }
    }
}
