<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Client\Request;
use Livewire\Component;

class ProductDescriptionComponent extends Component
{

    public $productId;
    public $product;

    public function mount($id)
    {
        $this->productId = $id;
    }

    public function render()
    {
        $this->loadProduct();
        return view('livewire.product-description-component')->extends('layouts.app')->section('content');
    }

    public function addtocart($pId)
    {
        Cart::create([
            'product_id' => $pId,
            'user_id' => auth()->user()->id,
            'quantity' => 1,
        ]);
        return redirect(request()->header('Referer'));
    }

    public function loadProduct()
    {
        $item = Product::findOrFail($this->productId);
        $item->images;
        $carts = Cart::select('*')->where('user_id', auth()->user()->id)->get();
        $item->cart = $carts;
        $this->product = $item;
    }
}
