<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use App\Models\Product;
use Livewire\Component;

class CartComponent extends Component
{
    public $cart_items = array();
    public $sub_total = 0;

    public function render()
    {
        $this->loadCartItems();
        return view('livewire.cart-component')->extends('layouts.app')->section('content');
    }

    public function loadCartItems()
    {
        $items = Cart::select('*')->where('user_id', auth()->user()->id)->get();

        //setting product details
        $result = array();
        foreach ($items as $item) {
            $product = Product::findOrFail($item->product_id);
            $product->images;
            $product->total = ($product->price * $item->quantity);
            $product->quantity = $item->quantity;
            $product->inventory;
            array_push($result, $product);
        }

        //setting sub total
        foreach ($result as $r) {
            $this->sub_total += $r->total;
        }

        $this->cart_items = $result;
    }
}
