<?php

namespace App\Http\Livewire;

use App\Models\Discount;
use Livewire\Component;



class DiscountComponent extends Component
{
    public $searchString = "";
    public $items = array();
    public $dataFrom = 0;
    public $dataTo = 7;
    public $listeners = ['delete'];
    public $discountId = 0;
    public $discount_percent;
    public $discountStatus = "";
    public $discounts = array();
    public $status = "";
    public $name = "";
    public $description = "";
    public $singleItem = "";

    public function render()
    {
        $this->loadData();
        return view('livewire.discount-component');
    }

    public function clearTextFields()
    {
        $this->discountId = 0;
        $this->status = "";
        $this->name = "";
        $this->description = "";
        $this->singleItem = "";
        $this->discount_percent = "";
        $this->discountStatus = "";
    }

    public function loadData()
    {
        $data = Discount::latest('id')
            ->where('name', 'LIKE', '%' . $this->searchString . '%')
            ->skip($this->dataFrom)->take($this->dataTo)->get();

        $this->items = $data;
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

    public function save()
    {
        $this->validate([
            'discountStatus' => 'required',
            'discount_percent' => 'required|numeric',
            'name' => 'required|string',
            'description' => 'required|string',
        ]);

        $product = Discount::create([
            'active' => $this->discountStatus,
            'status' => 'temp',
            'name' => $this->name,
            'description' => $this->description,
            'discount_percent' => $this->discount_percent,
        ]);

        $this->dispatchBrowserEvent('swal:success', [
            'type' => 'success',
            'title' => 'Discount ' . $this->name . ' Added Successfully!',
            'text' => '',
        ]);

        $this->clearTextFields();
    }

    public function loadOneItem($id)
    {
        $data = Discount::findOrFail($id);
        $this->singleItem = $data;
    }

    public function prepareEdit($id)
    {
        $this->loadOneItem($id);

        $this->discountId = $this->singleItem['id'];
        $this->discountStatus = $this->singleItem['active'];
        $this->name = $this->singleItem['name'];
        $this->description = $this->singleItem['description'];
        $this->discount_percent = $this->singleItem['discount_percent'];
    }

    public function update()
    {
        $this->validate([
            'discountStatus' => 'required',
            'discount_percent' => 'required|numeric',
            'name' => 'required|string',
            'description' => 'required|string',
        ]);

        $data = Discount::findOrFail($this->discountId);
        $data->status = $this->status;
        $data->active = $this->discountStatus;
        $data->name = $this->name;
        $data->description = $this->description;
        $data->discount_percent = $this->discount_percent;

        $data->save();
        $this->dispatchBrowserEvent('swal:success', [
            'type' => 'success',
            'title' => 'Discount Updated Successfully!',
            'text' => '',
        ]);
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

    public function delete($id)
    {
        $data = Discount::findOrFail($id);
        $data->delete();
    }


    public function deepSearch()
    {
        $this->items = array();
        $this->dataFrom = 0;
        $this->dataTo = 7;

        $this->loadData();
    }
}
