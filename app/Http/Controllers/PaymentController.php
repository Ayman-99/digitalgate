<?php

namespace App\Http\Controllers;


use App\Mail\OrderShipped;
use App\Models\Discount;
use App\Models\Order;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use PayPal\Api\Amount;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use stdClass;


/*
 * todo(severe): Check error cases for payment
 */

class PaymentController extends Controller
{
    private $apiContext;
    private $secret;
    private $clientId;

    public function __construct()
    {
        if (config('paypal.settings.mode') == 'live') {
            $this->clientId = config('paypal.live_client_id');
            $this->secret = config('paypal.live_secret');
        } else {
            $this->clientId = config('paypal.sandbox_client_id');
            $this->secret = config('paypal.sandbox_secret');
        }
        $this->apiContext = new ApiContext(new OAuthTokenCredential($this->clientId, $this->secret));
        $this->apiContext->setConfig(config('paypal.settings'));
    }

    public function payWithPaypal(Request $request)
    {
        //if user balance > order use case here

        // else user balance < order
        //Set payer
        $payer = new Payer();
        $payer->setPaymentMethod("paypal");

        $items = array();
        $total = 0;
        $errorItems = 0;
        foreach (Cart::instance('shopping')->content() as $cartItem) {
            $product = Product::find($cartItem->id);
            if ($product->sale == 0) {
                if ($product->price != $cartItem->price) {
                    $errorItems++;
                    continue;
                }
            } else {
                if ($product->sale != $cartItem->price) {
                    $errorItems++;
                    continue;
                }
            }
            $item = new Item();
            $item->setName($cartItem->name)
                ->setCurrency('USD')
                ->setQuantity($cartItem->qty)
                ->setSku($cartItem->id) // Similar to `item_number` in Classic API
                ->setPrice($cartItem->price);
            $total = $total + $cartItem->qty * $cartItem->price;
            array_push($items, $item);
        }
        if (session()->has('discount')) {
            $discount = new Item();
            $discount->setName('Discount')
                ->setCurrency('USD')
                ->setQuantity(1)
                ->setPrice("-" . session()->get('discount'));
            $total = $total - session()->get('discount');
            array_push($items, $discount);
        }
        session("wrongItems", $errorItems);
        $itemList = new ItemList();
        $itemList->setItems($items);
        $amount = new Amount();
        $amount->setCurrency("USD")
            ->setTotal($total);
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription("Buying items from digitalgate");

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(route('front.pay.status'))
            ->setCancelUrl(route('front.pay.cancelled'));

        $payment = new Payment();
        $payment->setIntent("sale")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));
        try {
            $payment->create($this->apiContext);
        } catch (\PayPal\Exception\PPCOnnectionException $ex) {
            die($ex);
        }
        $approvalUrl = $payment->getApprovalLink();
        return redirect($approvalUrl);
    }

    public function status(Request $request)
    {
        if (empty($request->input('PayerID')) || empty($request->input('token'))) {
            return redirect()->route('front.home');
        } else if (Cart::instance('shopping')->count() > 0) {
            $paymentId = $request->get('paymentId');
            $payment = Payment::get($paymentId, $this->apiContext);
            $execution = new PaymentExecution();
            $execution->setPayerId($request->input('PayerID'));
            $result = $payment->execute($execution, $this->apiContext);
            if ($result->getState() == 'approved') {
                Cart::instance('shopping')->destroy();
                $user = Auth::user();
                $user->balance = $user->balance + $result->getTransactions()[0]->getAmount()->total * 0.01;
                $discount = 0;
                $order = Order::create([
                    'user_id' => Auth::id(),
                    'transaction' => $result->getTransactions()[0]->related_resources[0]->sale->id,
                    'total' => $result->getTransactions()[0]->getAmount()->total,
                    'status' => 'Pending'
                ]);
                if (session()->get('wrongItems') > 0) {
                    $order->status = "Pending";
                } else {
                    $order->status = "Completed";
                }
                if (session()->has('discount')) {
                    $user->balance -= session()->get('discount');
                    Discount::create([
                        'user_id' => Auth::id(),
                        'order_id' => $order->id,
                        'amount' => session()->get('discount')
                    ]);
                    $discount = session()->get('discount');
                    session()->remove('discount');
                }
                $codesToShow = array();
                foreach ($result->getTransactions()[0]->getItemList()->getItems() as $obj) {
                    if ($obj->name == "Discount") {
                        continue;
                    }
                    $product = Product::where('id', $obj->sku)->with('items')->first();
                    $code = $product->items->where('activated', '=', 0)->first();
                    $code->activated = '1';
                    $code->order_id = $order->id;
                    $code->save();
                    array_push($codesToShow, $product);
                }
                $order->save();
                $user->save();
                Mail::to(Auth::user())->send(new OrderShipped($order, $codesToShow, $discount));
                $flag = 1;
                $status = $order->status;
                return view('success', compact('flag', 'status'));
            } else {
                $flag = 2;
                return view('success', compact('flag'));
            }
        } else {
            return redirect()->route('front.home');
        }
    }

    public function cancelled()
    {
        return view('cancelled')->with('flag', 1);
    }
}
