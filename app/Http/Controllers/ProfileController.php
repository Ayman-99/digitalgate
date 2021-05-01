<?php

namespace App\Http\Controllers;


use App\Models\Address;
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
        $order = Order::where('id', $request->order_id)->with('items')->with('user')->first();
        $discount = 0;
        if(Discount::where('order_id','=', $request->order_id)->exists()){
            $discount = Discount::where('order_id','=', $request->order_id)->first()->amount;
        }
        $user = $order->user;
        $items = $order->items;
        $arrs = array();
        foreach ($items as $item) {
            $productName = $item->product->name;
            $row = new class() {
                public $productName;
                public $productItems = array();
            };
            $row->productName = $productName;
            array_push($arrs, $row);
        }
        $arrs = array_unique($arrs, SORT_REGULAR);
        foreach ($items as $item) {
            $productName = $item->product->name;
            foreach ($arrs as $row) {
                if ($row->productName === $productName) {
                    array_push($row->productItems, $item->value);
                }
            }
        }
        $body = "";
        $totalAll = $order->total;
        foreach($arrs as $row){
            $temp = "";
            $temp .= "<ul>";
            foreach($row->productItems as $item){
                $temp .= "<li>" . $item . "</li>";
            }
            $temp .= "</ul>";
            $body .= "<tr>";
            $body .= "<td class='left strong'>$row->productName</td>";
            $body .= "<td class='left'>$temp</td>";
            $body .= "</tr>";
        }
        if(Address::where('user_id', '=', $user->id)->exists()){
            return response(array(
                'success' => true,
                'body' => $body,
                'userName' => "Name: " . $user->name,
                'userEmail' => "Email: " . $user->email,
                'userCountry' => "Country: " . $user->address->country,
                'userCode' => "Code: " . $user->address->code,
                'userStreet' => "Street: " . $user->address->street,
                'subTotal' => "$" . $totalAll,
                'discount' => "$" . $discount,
                'total' => "$" . ($totalAll - $discount)
            ), 200, []);
        } else {
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

    public function updateAddress(Request $request, $name){
        $validated = $request->validate([
            'country' => ['bail', 'required', 'string', 'min:3', 'max:15'],
            'street' => ['required','string', 'min:3','max:25'],
            'code' => ['required','string', 'min:3','max:25']
        ]);
        session()->flash('messageUpdateData', "Data has been updated");
        session()->flash('updateAddressFlag', "1");
        if(Address::where('user_id', '=', Auth::id())->exists()){
            $address = Address::where('user_id', '=', Auth::id())->first();
            $address->country = $this->validation_input($request->input('country'));
            $address->code = $this->validation_input($request->input('code'));
            $address->street = $this->validation_input($request->input('street'));
            $address->save();
        } else {
            Address::create([
                'user_id' => Auth::id(),
                'country' => $this->validation_input($request->input('country')),
                'code' => $this->validation_input($request->input('code')),
                'street' => $this->validation_input($request->input('street')),
            ]);
        }
        return redirect()->route('front.profile.home', ['name' => Auth::user()->name, 'tab' => 'settings']);
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
