<?php

namespace App\Http\Livewire;

use App\Models\Discount;
use App\Models\Product as ModelsProduct;
use App\Models\ProductCategory;
use Livewire\Component;

class Product extends Component
{
    public $searchString = "";
    public $items = array();
    public $dataFrom = 0;
    public $dataTo = 7;
    public $listeners = ['delete'];
    public $productId = 0;
    public $productCategoryId = "";
    public $categories = array();
    public $productInventoryId = "";
    public $discountId = "";
    public $discounts = array();
    public $status = "";
    public $name = "";
    public $description = "";
    public $price = "";

    public function render()
    {
        $this->loadData();
        $this->loadCategories();
        $this->loadDiscounts();
        return view('livewire.product');
    }

    public function clearTextFields()
    {
        $this->categoryName = "";
        $this->categoryDescription = "";
    }
    public function loadData()
    {
        $this->items = ModelsProduct::latest('id')
            ->where('name', 'LIKE', '%' . $this->searchString . '%')
            ->skip($this->dataFrom)->take($this->dataTo)->get();
    }

    public function loadCategories()
    {
        $this->categories = ProductCategory::all();
    }

    public function loadDiscounts()
    {
        $this->discounts = Discount::all();
    }

    public function incrementPages()
    {
        $this->dataFrom += 7;
        $this->dataTo += 7;
        $this->loadData();

        if (count($this->items) === 0) {
            $this->dataFrom -= 7;
            $this->dataTo -= 7;
        }
    }

    public function decrementPages()
    {
        $this->dataFrom -= 7;
        $this->dataTo -= 7;
        $this->loadData();

        if (count($this->items) === 0) {
            $this->dataFrom += 7;
            $this->dataTo += 7;
        }
    }

    public function setCategory($data)
    {
        $this->productCategoryId = $data;
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
            'productCategoryId' => 'required|integer'
        ]);

        $this->dispatchBrowserEvent('swal:success', [
            'type' => 'success',
            'title' => 'Product ' . $this->name . ' Added Successfully!',
            'text' => '',
        ]);

        $this->clearTextFields();
    }

    public function prepareEdit($id)
    {
        $data = ModelsProduct::findOrFail($id);

        $this->productId = $data->id;
        $this->productCategoryId = $data->product_category_id;
        $this->productInventoryId = $data->product_inventory_id;
        $this->discountId = $data->discount_id;
        $this->status = $data->status;
        $this->name = $data->name;
        $this->description = $data->description;
        $this->price = $data->price;
    }

    public function update()
    {

        $data = ModelsProduct::findOrFail($this->productId);

        $data->id = $this->productId;
        $data->product_category_id = $this->productCategoryId;
        $data->product_inventory_id = $this->productInventoryId;
        $data->discount_id = $this->discountId;
        $data->status = $this->status;
        $data->name = $this->name;
        $data->description = $this->description;
        $data->price = $this->price;

        $data->save();
        $this->dispatchBrowserEvent('swal:success', [
            'type' => 'success',
            'title' => 'Product Updated Successfully!',
            'text' => '',
        ]);
    }

    public function delete($id)
    {
        ModelsProduct::findOrFail($id)->delete();
    }

    public function deepSearch()
    {
        $this->items = array();
        $this->dataFrom = 0;
        $this->dataTo = 7;

        $this->loadData();
    }
}
