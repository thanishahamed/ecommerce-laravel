<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class HomeComponent extends Component
{

    public $products = array();

    public function render()
    {
        $this->loadProducts();
        return view('livewire.home-component');
    }

    public function loadProducts()
    {
        $items = Product::inRandomOrder()->get();

        foreach ($items as $item) {
            $res = Product::find($item->id);

            $res->images;
            array_push($this->products, $res);
        }
    }
}
