<?php

namespace App\Http\Livewire;

use Livewire\Component;

class HomeComponent extends Component
{
    public $inputText = "sample";

    public function render()
    {
        return view('livewire.home-component', [
            'inputText' => $this->inputText
        ]);
    }

    public function changeInput()
    {
        $this->inputText = "huray changed now";
    }
}
