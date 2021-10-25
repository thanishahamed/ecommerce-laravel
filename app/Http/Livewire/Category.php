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
    public $categoryId = 0;
    public $categoryName = "";
    public $categoryDescription = "";

    public function render()
    {
        $this->loadCategories();
        return view('livewire.category', ['categories' => $this->categories]);
    }

    public function clearTextFields()
    {
        $this->categoryName = "";
        $this->categoryDescription = "";
    }
    public function loadCategories()
    {
        $this->categories = ProductCategory::latest('id')
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

    public function save()
    {
        $this->validate([
            'categoryName' => 'required|string',
            'categoryDescription' => 'required|string'
        ]);

        ProductCategory::create([
            'name' => $this->categoryName,
            'description' => $this->categoryDescription,
            'status' => 'active'
        ]);
        $this->dispatchBrowserEvent('swal:success', [
            'type' => 'success',
            'title' => 'Category Added Successfully!',
            'text' => '',
        ]);

        $this->clearTextFields();
    }

    public function prepareEdit($id)
    {
        $cat = ProductCategory::findOrFail($id);

        $this->categoryName = $cat->name;
        $this->categoryId = $cat->id;
        $this->categoryDescription = $cat->description;
    }

    public function update()
    {
        $this->validate([
            'categoryName' => 'required|string',
            'categoryDescription' => 'required|string'
        ]);

        $cat = ProductCategory::findOrFail($this->categoryId);

        $cat->name = $this->categoryName;
        $cat->description = $this->categoryDescription;

        $cat->save();
        $this->dispatchBrowserEvent('swal:success', [
            'type' => 'success',
            'title' => 'Category Updated Successfully!',
            'text' => '',
        ]);
    }

    public function deleteCategory($id)
    {
        ProductCategory::findOrFail($id)->delete();
    }

    public function deepSearch()
    {
        // $this->searchString = "";
        $this->categories = array();
        $this->dataFrom = 0;
        $this->dataTo = 7;

        $this->loadCategories();
    }
}
