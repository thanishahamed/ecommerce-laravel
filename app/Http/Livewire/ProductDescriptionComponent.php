<?php

namespace App\Http\Livewire;

use App\Models\Product;
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
        $this->product = $item;
    }

    public function render()
    {
        return view('livewire.product-description-component');
    }
}
