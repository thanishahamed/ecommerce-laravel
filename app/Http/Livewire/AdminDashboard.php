<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AdminDashboard extends Component
{
    public $tab = "product";

    public function render()
    {
        return view('livewire.admin-dashboard', ['tab' => $this->tab])->extends('layouts.app')->section('content');
    }

    public function switch_tab($t)
    {
        $this->tab = $t;
    }
}
