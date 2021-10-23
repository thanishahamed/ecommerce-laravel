<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SearchDisplay extends Component
{
    public $searchString = "none";

    public function mount($searchString)
    {
        $this->searchString = $searchString;
    }

    public function render()
    {
        return view('livewire.search-display', ['searchString' => $this->searchString])->extends('layouts.app')->section('content');
    }
}
