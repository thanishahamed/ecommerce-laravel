<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\ProductCategory;
use Livewire\Component;

class CategoryComponent extends Component
{

    public $categories = array();
    public $productCategorized = array();
    public $categoryId = 1;


    public function render()
    {
        $this->updateCategoryArray($this->categoryId);
        $this->loadCategories();
        return view('livewire.category-component');
    }

    public function updateCategoryArray($catId)
    {
        $items = Product::select('*')->where('product_category_id', $catId)->get();
        // $this->productCategorized = null;
        $arrr = array();
        foreach ($items as $item) {
            $res = Product::find($item->id);

            $res->images;
            array_push($arrr, $res);
        }

        $this->productCategorized = $arrr;
    }

    public function loadCategories()
    {
        $this->categories = ProductCategory::all();
    }

    public function switchCategory($catId)
    {
        $this->categoryId = $catId;
    }
}
