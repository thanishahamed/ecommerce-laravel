<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use App\Models\OrderDetail;
use App\Models\OrderItem;
use App\Models\PaymentDetail;
use App\Models\Product;
use App\Models\ProductInventory;
use App\Models\UserAddress;
use App\Models\UserPayment;
use Livewire\Component;

class CheckoutComponent extends Component

{

    public $cart_items = array();
    public $sub_total = 0;
    public $firstname;
    public $lastname;
    public $email;
    public $telephone;
    public $address;
    public $country;
    public $postalcode;
    public $city;
    public $paymentmethod = "BANK";

    public function render()
    {
        $this->loadCartItems();
        return view('livewire.checkout-component')->extends('layouts.app')->section('content');
    }

    public function loadCartItems()
    {
        $this->cart_items = array();
        $this->sub_total = 0;
        $items = Cart::select('*')->where('user_id', auth()->user()->id)->get();

        //setting product details
        $result = array();
        foreach ($items as $item) {
            $product = Product::findOrFail($item->product_id);
            $product->images;
            $product->total = ($product->price * $item->quantity);
            $product->quantity = $item->quantity;
            $product->inventory;
            $product->cart_item_id = $item->id;
            array_push($result, $product);
        }

        //setting sub total
        foreach ($result as $r) {
            $this->sub_total += $r->total;
        }

        $this->cart_items = $result;
    }

    public function placeOrder()
    {
        $this->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            'telephone' => 'required',
            'address' => 'required',
            'country' => 'required',
            'postalcode' => 'required',
            'city' => 'required',
            'paymentmethod' => 'required',
        ]);

        $this->loadCartItems();
        //checking inventory
        foreach ($this->cart_items as $item) {
            if ($item->inventory->quantity >= $item->quantity) {
            } else {
                session()->flash('message', 'Sorry you are late. some items you ordered are out of stock. Please check your cart once again!');
                return redirect(route('cart'));
            }
        }

        //store user addresses
        $addresses = UserAddress::create([
            'user_id' => auth()->user()->id,
            'address_line1' => $this->address,
            'address_line2' => $this->address,
            'city' => $this->city,
            'postal_code' => $this->postalcode,
            'country' => $this->country,
            'telephone' => $this->telephone,
            'mobile' => $this->telephone,
        ]);

        //store user user payments
        $userPayments = UserPayment::create([
            'user_id' => auth()->user()->id,
            'payment_type' => $this->paymentmethod,
            'provider' => 'COMMERCIAL',
            'account_no' => '123456',
            'expiry' => time(),
        ]);

        //store user payments details
        $payment_details = PaymentDetail::create([
            'amount' => $this->sub_total,
            'order_detail_id' => 0,
            'payment_type' => $this->paymentmethod,
            'provider' => 'COMMERCIAL',
            'status' => 'PAID',
        ]);

        //store order details
        $order_details = OrderDetail::create([
            'user_id' => auth()->user()->id,
            'payment_detail_id' => $payment_details->id,
            'total' => $this->sub_total,
        ]);

        //update order_details id in payment detail
        $payment_details->order_detail_id = $order_details->id;
        $payment_details->update();

        //update order items
        foreach ($this->cart_items as $item) {
            if ($item->inventory->quantity >= $item->quantity) {
                //reduce inventory
                $inv = ProductInventory::findOrFail($item->inventory->id);
                $inv->quantity  -= $item->quantity;
                $inv->update();

                //insert into order items
                $order_item = OrderItem::create([
                    'order_detail_id' => $order_details->id,
                    'product_id' => $item->id,
                    'quantity' => $item->quantity
                ]);

                //remove from cart
                $cartItem = Cart::findOrFail($item->cart_item_id)->delete();
            } else {
                session()->flash('stock-message', 'Sorry you are late. some items you ordered are out of stock. Please check your cart once again!');
                return redirect(route('cart'));
            }
        }

        return redirect(route('thank-you'));
    }
}
