<?php

namespace App\Http\Controllers;


use App\Models\Order;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        session("wrongItems", $errorItems);
        $itemList = new ItemList();
        $itemList->setItems($items);
        $amount = new Amount();
        $amount->setCurrency("USD")
            ->setTotal(Cart::instance('shopping')->subtotal());

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
        } else if(Cart::instance('shopping')->count() > 0){
            $paymentId = $request->get('paymentId');
            $payment = Payment::get($paymentId, $this->apiContext);
            $execution = new PaymentExecution();
            $execution->setPayerId($request->input('PayerID'));
            $result = $payment->execute($execution, $this->apiContext);
            if ($result->getState() == 'approved') {
                Cart::instance('shopping')->destroy();
                $order = Order::create([
                    'user_id' => Auth::id(),
                    'transaction' => $result->getTransactions()[0]->related_resources[0]->sale->id,
                    'total' => $result->getTransactions()[0]->getAmount()->total,
                    'status' => 'Pending'
                ]);
                if(session()->get('wrongItems') > 0){
                    $order->status = "Pending";
                } else {
                    $order->status = "Completed";
                }
                $order->save();
                foreach ($result->getTransactions()[0]->getItemList()->getItems() as $obj) {
                    $code = Product::find($obj->sku)->first()->items->where('activated', '=', 0)->first();
                    $code->activated = '1';
                    $code->order_id = $order->id;
                    $code->save();
                }
                $format = new stdClass();
                $format->id = $order->id;
                $format->transaction = $result->getTransactions()[0]->related_resources[0]->sale->id; //transaction id
                $format->created_at = $result->getCreateTime();
                $format->status = $order->status;
                if($order->status == "Completed"){
                    $format->items = $result->getTransactions()[0]->getItemList()->getItems();
                } else {
                    $format->items = null;
                }
                $format->subtotal = $order->total;
                $format->discount = 0;
                $format->name = Auth::user()->name;
                $format->email = Auth::user()->email;
                //$html = view('emails.mails.invoice', ['order' => $order])->render();
                //sendEmail($user->email, $user->address->fname . " " . $user->address->lname, 'Order#' . $newOrderId, $html);
                //sendEmail('dawoodhalawa@gmail.com', $user->address->fname . " " . $user->address->lname, 'Order#' . $newOrderId, $html);
                $flag = 1;
                $status = $order->status;
                return view('success', compact('flag','status'));
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
