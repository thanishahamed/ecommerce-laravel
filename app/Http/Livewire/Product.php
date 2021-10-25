<?php

namespace App\Http\Livewire;

use App\Models\Discount;
use App\Models\Product as ModelsProduct;
use App\Models\ProductCategory;
use App\Models\ProductInventory;
use Livewire\Component;
use Livewire\WithFileUploads;

class Product extends Component
{
    use WithFileUploads;
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
    public $stockStatus = "";
    public $discounts = array();
    public $status = "";
    public $name = "";
    public $description = "";
    public $price = "";
    public $singleItem = "";
    public $quantity = "";
    public $images = array();
    public $image;
    public $tempData;

    public function render()
    {
        $this->loadData();
        $this->loadCategories();
        $this->loadDiscounts();
        return view('livewire.product');
    }

    public function clearTextFields()
    {
        $this->productId = 0;
        $this->productCategoryId = "";
        $this->productInventoryId = "";
        $this->discountId = "";
        $this->status = "";
        $this->name = "";
        $this->description = "";
        $this->price = "";
        $this->singleProduct = "";
    }

    public function loadData()
    {
        $data = ModelsProduct::latest('id')
            ->where('name', 'LIKE', '%' . $this->searchString . '%')
            ->skip($this->dataFrom)->take($this->dataTo)->get();

        $this->items = $data;
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
            'productCategoryId' => 'required|integer',
            'price' => 'required|numeric',
            'name' => 'required|string',
            'description' => 'required|string',
        ]);

        $inventory = ProductInventory::create([
            'quantity' => 0,
            'status' => 'Out of stock'
        ]);

        $product = ModelsProduct::create([
            'product_category_id' => $this->productCategoryId,
            'product_inventory_id' => $inventory->id,
            'discount_id' => $this->discountId,
            'status' => 'active',
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
        ]);

        $this->dispatchBrowserEvent('swal:success', [
            'type' => 'success',
            'title' => 'Product ' . $this->name . ' Added Successfully!',
            'text' => '',
        ]);

        $this->clearTextFields();
    }

    public function loadOneItem($id)
    {
        $data = ModelsProduct::findOrFail($id);
        $data->orders;
        $data->category;
        $data->inventory;
        $data->images;
        $data->onCart;
        $data->discount;

        $this->singleItem = $data;
    }

    public function prepareEdit($id)
    {
        $this->loadOneItem($id);

        $this->productId = $this->singleItem['id'];
        $this->productCategoryId = $this->singleItem['product_category_id'];
        $this->productInventoryId = $this->singleItem['product_inventory_id'];
        $this->discountId = $this->singleItem['dicount_id'];
        $this->status = $this->singleItem['status'];
        $this->name = $this->singleItem['name'];
        $this->description = $this->singleItem['description'];
        $this->price = $this->singleItem['price'];
        $this->images = $this->singleItem['images'];

        $this->quantity = $this->singleItem['inventory']['quantity'];
        $this->stockStatus = $this->singleItem['inventory']['status'];
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
        $data = ModelsProduct::findOrFail($id);

        ProductInventory::findOrFail($data->product_inventory_id)->delete();
        $data->delete();
    }

    public function deepSearch()
    {
        $this->items = array();
        $this->dataFrom = 0;
        $this->dataTo = 7;

        $this->loadData();
    }

    public function uploadImage()
    {
        $this->validate([
            'image' => 'image|max:1024', // 1MB Max
        ]);

        $uploadedData = $this->image->storePublicly('images', 'public');
        $imageUrl = "/storage" . "/" . $uploadedData;
        $this->tempData = $imageUrl;
    }
}
