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
            $product->cart_item_id = $item->id;
            array_push($result, $product);
        }

        //setting sub total
        foreach ($result as $r) {
            $this->sub_total += $r->total;
        }

        $this->cart_items = $result;
    }

    public function deleteCartItem($id)
    {
        $item = Cart::findOrFail($id);

        $item->delete();
        return redirect(request()->header('Referer'));
    }

    public function updateQuantity($num, $cartItemId)
    {
        // dump($num);
        $item = Cart::findOrFail($cartItemId);
        $product = Product::findOrFail($item->product_id);

        $count = $product->inventory->quantity;
        if ($num === 0) {
            session()->flash('message', 'Alert: You must select at least one item!');
            return redirect(request()->header('Referer'));
        }
        if ($num > $count) {
            session()->flash('message', 'Warning: Only ' . $count . ' items found for ' . $product->name . "!");
        } else {
            $item->quantity = $num;
            $item->update();
        }
        return redirect(request()->header('Referer'));
    }
}
