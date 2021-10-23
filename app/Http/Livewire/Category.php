<?php

namespace App\Http\Livewire;

use App\Models\ProductCategory;
use Livewire\Component;

class Category extends Component
{
    public $searchString = "";
    public $categories = array();
    public $dataFrom = 0;
    public $dataTo = 7;
    public $listeners = ['deleteCategory'];

    public function render()
    {
        $this->loadCategories();
        return view('livewire.category', ['categories' => $this->categories]);
    }

    public function loadCategories()
    {
        $this->categories = ProductCategory::select('*')
            ->where('name', 'LIKE', '%' . $this->searchString . '%')
            ->skip($this->dataFrom)->take($this->dataTo)->get();
    }

    public function incrementPages()
    {
        $this->dataFrom += 7;
        $this->dataTo += 7;
        $this->loadCategories();

        if (count($this->categories) === 0) {
            $this->dataFrom -= 7;
            $this->dataTo -= 7;
        }
    }

    public function decrementPages()
    {
        $this->dataFrom -= 7;
        $this->dataTo -= 7;
        $this->loadCategories();

        if (count($this->categories) === 0) {
            $this->dataFrom += 7;
            $this->dataTo += 7;
        }
    }

    public function confirmDelete($id)
    {
        $this->dispatchBrowserEvent('swal:confirm', [
            'type' => 'warning',
            'title' => 'Are you sure?',
            'text' => '',
            'id' => $id
        ]);
    }

    public function deleteCategory($id)
    {
        ProductCategory::findOrFail($id)->delete();
    }
}
