<?php

namespace App\Http\Controllers;


use App\Models\Category;
use App\Models\Discount;
use App\Models\Item;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Base
{

    public function __construct()
    {
    }

    public function index(Request $request, $name)
    {
        $orders = Order::where('user_id', Auth::id())->paginate(20);
        return view('profile', compact('orders'));
    }

    public function getOrder(Request $request, $name)
    {
        $order = Order::where('id', $request->order_id)->with('items')->with('user')->get();
        $discount = Discount::where('order_id', $request->order_id)->first()->amount;
        $user = $order[0]->user;
        $items = $order[0]->items;
        $arrs = array();
        foreach ($items as $item) {
            $productName = $item->product->name;
            $productCost = $item->product->sale;
            $row = new class() {
                public $productName;
                public $productItems = array();
                public $productCost;
                public $productTotal = 0;
            };
            $row->productName = $productName;
            $row->productCost = $productCost;
            array_push($arrs, $row);
        }
        $arrs = array_unique($arrs, SORT_REGULAR);
        foreach ($items as $item) {
            $productName = $item->product->name;
            foreach ($arrs as $row) {
                if ($row->productName === $productName) {
                    array_push($row->productItems, $item->value);
                    $row->productTotal += $row->productCost;
                }
            }
        }
        $body = "";
        $totalAll = 0;
        foreach($arrs as $row){
            $temp = "";
            $total = 0;
            $temp .= "<ul>";
            foreach($row->productItems as $item){
                $total += $row->productCost;
                $temp .= "<li>" . $item . "</li>";
            }
            $temp .= "</ul>";
            $body .= "<tr>";
            $body .= "<td class='left strong'>$row->productName</td>";
            $body .= "<td class='left'>$temp</td>";
            $body .= "<td class='right'>$$row->productCost</td>";
            $body .= "<td class='right'>$$total</td>";
            $body .= "</tr>";
            $totalAll += $total;
        }
        return response(array(
            'success' => true,
            'body' => $body,
            'userName' => $user->name,
            'userEmail' => $user->email,
            'subTotal' => "$" . $totalAll,
            'discount' => "$" . $discount,
            'total' => "$" . ($totalAll - $discount)
        ), 200, []);
    }

    public function update(Request $request, $name)
    {
        $validated = $request->validate([
            'name' => ['bail', 'required', 'string', 'min:3', 'max:15'],
            'email' => ['required', 'string', 'email', 'min:3', 'max:255', $request->input('email') !== Auth::user()->email ? 'unique:users' : '', function ($attribute, $value, $fail) {
                if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $fail($attribute . ' is invalid.');
                }
            }],
            'confPass' => [function ($attribute, $value, $fail) {
                if (!Hash::check($value, Auth::user()->getAuthPassword())) {
                    session()->flash('updateDataFlag', "1");
                    $fail('Incorrect password');
                }
            }],
        ]);
        session()->flash('messageUpdateData', "Data has been updated");
        $user = User::find(Auth::id());
        $user->name = $this->validation_input($request->input('name'));
        $user->email = $this->validation_input($request->input('email'));
        $user->save();
        return redirect()->route('front.profile.home', ['name' => $user->name, 'tab' => 'settings']);
    }

    public function updatePassword(Request $request, $name)
    {
        $validated = $request->validate([
            'oldpass' => ['bail', 'required', 'string', 'min:3', 'max:15', function ($attribute, $value, $fail) {
                if (!Hash::check($value, Auth::user()->getAuthPassword())) {
                    $fail('Old password is incorrect');
                    session()->flash('updatePasswordFlag', "1");
                }
            }],
            'newpass' => ['required', 'string', 'min:8', 'max:22']
        ]);
        session()->flash('messageUpdatePassword', "Password has been changed");
        $user = Auth::user();
        $user->password = Hash::make($request->input('newpass'));
        $user->save();
        return redirect()->route('front.profile.home', ['name' => $user->name, 'tab' => 'settings']);
    }
}
