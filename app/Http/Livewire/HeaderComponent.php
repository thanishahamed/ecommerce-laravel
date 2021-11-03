<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use Livewire\Component;

class HeaderComponent extends Component
{
    public $searchString = "";
    public $cartCount;

    public function render()
    {
        $this->loadCartCount();
        return view('livewire.header-component', ['searchString' => $this->searchString]);
    }

    public function search()
    {
        return redirect()->route('search', ['searchString' => $this->searchString]);
    }

    public function loadCartCount()
    {
        $results = Cart::select('*')->where('user_id', auth()->user() ? auth()->user()->id : "")->get();
        $this->cartCount = count($results);
    }
}
