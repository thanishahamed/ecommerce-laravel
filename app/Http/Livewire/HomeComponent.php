<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\ProductCategory;
use Livewire\Component;

class HomeComponent extends Component
{

    public $products = array();


    public function render()
    {
        $this->loadProducts();
        return view('livewire.home-component')->extends('layouts.app')->section('content');;
    }

    public function loadProducts()
    {
        $items = Product::inRandomOrder()->get();
        $array = array();
        foreach ($items as $item) {
            $res = Product::find($item->id);

            $res->images;
            array_push($array, $res);
        }
        $this->products = $array;
    }
}
