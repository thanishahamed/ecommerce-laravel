<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use Livewire\Component;

class HeaderComponent extends Component
{
    public $searchString = "";

    public function render()
    {
        return view('livewire.header-component', ['searchString' => $this->searchString, 'cartCount' => Cart::count()]);
    }

    public function search()
    {
        return redirect()->route('search', ['searchString' => $this->searchString]);
    }
}
