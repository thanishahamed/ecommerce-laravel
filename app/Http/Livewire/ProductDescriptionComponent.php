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
        $item = Product::findOrFail($id);
        $item->images;
        $item->cart;
        $this->product = $item;
    }

    public function render()
    {
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
}
