<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ThankYouComponent extends Component
{
    public function render()
    {
        return view('livewire.thank-you-component')->extends('layouts.app')->section('content');
    }
}
