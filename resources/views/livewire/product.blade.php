<div>
    <div class="card">
        <div class="card-body">
            <h1> Manage Products </h1>
            <hr />
            <div class="lds-ellipsis" wire:loading.delay>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>

            <!-- Cutom Data Table Start Area-->

            <div>
                <div class="row">
                    <div class="col">
                        <button type="button" wire:click="clearTextFields" class="btn btn-success pull-right" data-toggle="modal" data-target="#exampleModal">
                            Add Product
                        </button>
                    </div>
                </div>

                <div class="row py-2 justify-content-center text-center">
                    <div class="col-7">
                        <label> Search Records </label>
                        <input type="text" class="form-control" wire:model="searchString" placeholder="Search By Names">
                        <input type="button" class="btn btn-info" wire:click="deepSearch" value="Deep Search">
                    </div>
                </div>
            </div>

            <!-- Modal Add Category-->
            <div wire:ignore.self class="modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" align="center" id="exampleModalLabel">Add a product!</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h1> Add Product </h1>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="name"> Product Name: </label>
                                        <input class="form-control" id="name" type="text" wire:model="name" placeholder="Enter product name">
                                        @if($errors->has('name'))
                                        <div class="text-danger text-strong"> {{$errors->first('name')}} </div>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="name"> Product Unit Price (LKR): </label>
                                        <input class="form-control" id="name" type="number" wire:model="price" placeholder="Enter product name">
                                        @if($errors->has('price'))
                                        <div class="text-danger text-strong"> {{$errors->first('price')}} </div>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="name"> Product Category: @if($productCategoryId>0) <span class="text-success"> Selected </span> @endif</label>
                                        <select class="form-control form-control-sm" wire:model="productCategoryId">
                                            <option value="">Select</option>
                                            @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('productCategoryId'))
                                        <div class="text-danger text-strong"> {{$errors->first('productCategoryId')}} </div>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="name"> Discount: (optional) @if($discountId>0) <span class="text-success"> Selected </span> @endif</label>
                                        <select class="form-control form-control-sm" wire:model="discountId">
                                            <option value="">Select</option>
                                            @foreach($discounts as $discount)
                                            <option value="{{$discount->id}}">{{$discount->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="desc"> Description: </label>
                                        <textarea class="form-control" id="desc" wire:model="description" placeholder="Brief description about the product"></textarea>
                                        @if($errors->has('description'))
                                        <div class="text-danger"> {{$errors->first('description')}} </div>
                                        @endif
                                    </div>
                                    <button type="button" class="btn btn-primary pull-right" id="addButton" wire:click="save">SAVE</button>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Edit Product-->
            <div wire:ignore.self class="modal" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" align="center" id="exampleModalLabel">Edit a product!</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h1> Edit Product </h1>
                            <!-- Basic Info -->
                            <div class="alert alert-secondary text-large">
                                Basic Information
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="name"> Product Name: </label>
                                        <input class="form-control" id="name" type="text" wire:model="name" placeholder="Enter product name">
                                        @if($errors->has('name'))
                                        <div class="text-danger text-strong"> {{$errors->first('name')}} </div>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="name"> Product Unit Price (LKR): </label>
                                        <input class="form-control" id="name" type="number" wire:model="price" placeholder="Enter product name">
                                        @if($errors->has('price'))
                                        <div class="text-danger text-strong"> {{$errors->first('price')}} </div>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="name"> Product Category: @if($productCategoryId>0) <span class="text-success"> Selected </span> @endif</label>
                                        <select class="form-control form-control-sm" wire:model="productCategoryId">
                                            <option value="">Select</option>
                                            @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('productCategoryId'))
                                        <div class="text-danger text-strong"> {{$errors->first('productCategoryId')}} </div>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="name"> Discount: (optional) @if($discountId>0) <span class="text-success"> Selected </span> @endif</label>
                                        <select class="form-control form-control-sm" wire:model="discountId">
                                            <option value="">Select</option>
                                            @foreach($discounts as $discount)
                                            <option value="{{$discount->id}}">{{$discount->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="desc"> Description: </label>
                                        <textarea class="form-control" id="desc" wire:model="description" placeholder="Brief description about the product"></textarea>
                                        @if($errors->has('description'))
                                        <div class="text-danger"> {{$errors->first('description')}} </div>
                                        @endif
                                    </div>
                                    <button type="button" class="btn btn-primary pull-right" id="addButton" wire:click="update">UPDATE</button>
                                </div>
                            </div>
                            <!-- Ending Basic Info -->
                            <hr>
                            <div class="alert alert-secondary text-large">
                                Inventory Information
                            </div>
                            <!-- Inventory -->
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="name"> Quantity: </label>
                                        <input class="form-control" id="name" type="number" wire:model="quantity" placeholder="Enter product name">
                                        @if($errors->has('quantity'))
                                        <div class="text-danger text-strong"> {{$errors->first('quantity')}} </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="name"> Stock Status: @if($stockStatus !== "") <span class="text-success"> Selected </span> @endif</label>
                                        <select class="form-control form-control-sm" wire:model="stockStatus">
                                            <option value="">Select</option>
                                            <option value="Out of stock">Out of stock</option>
                                            <option value="In stock">In stock</option>
                                        </select>
                                        @if($errors->has('productCategoryId'))
                                        <div class="text-danger text-strong"> {{$errors->first('productCategoryId')}} </div>
                                        @endif
                                    </div>

                                    <button type="button" class="btn btn-primary pull-right" id="addButton" wire:click="updateProductInventory({{$inventoryId}})">UPDATE INVENTORY</button>
                                </div>
                            </div>

                            <!-- Product Images -->
                            <div class="row">
                                <div class="col">
                                    <div class="py-3">Click on an image to delete</div>
                                    <div class="form-group">
                                        @if($errors->has('image'))
                                        <div class="text-danger text-strong alert alert-warning"> @if($errors->first('image') === 'The image must be an image.') Please choose an image first @else {{$errors->first('image')}} @endif </div>
                                        @endif
                                        <div style="display: flex; flex-wrap:wrap">
                                            @foreach($images as $image)
                                            <img src="{{$image->slug}}" alt="product" width="200" class="img-thumbnail" wire:click="confirmDeleteImage({{$image->id}});">
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">

                                        <div style="display: flex;">
                                            <div class="input-group">
                                                <input type="file" wire:model="image" class="file-input" id="inputGroupFile">
                                                <button type="button" class="btn btn-primary my-3" id="addButton" wire:click="uploadImage">Upload Image</button>
                                            </div>


                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
                        </div>
                    </div>
                </div>
            </div>


            <div class="overflow-auto" style="min-height: 450px; max-height: 450px; max-width: '100%';">
                <table align="center" class="table table-striped border datatable">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Price (LKR)</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Price (LKR)</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($items as $item)
                        <tr class="align-middle">
                            <td>{{$item->id}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->description}}</td>
                            <td>Rs. {{$item->price}}</td>
                            <td>{{$item->created_at}}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                    <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#editModal" wire:click="prepareEdit({{$item->id}})">More</button>
                                    <button type="button" class="btn btn-outline-danger" wire:click="confirmDelete({{$item->id}})">Delete</button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="btn-group" role="group" aria-label="Basic outlined example">
                <button type="button" class="btn btn-outline-primary" wire:click="decrementPages">Previous</button>
                <button type="button" class="btn btn-outline-primary" wire:click="incrementPages">Next</button>
            </div>
            <!-- Ending Cutom Data Table -->
        </div>
    </div>

    <!-- Javascript Part -->
    <script>
        window.addEventListener('swal:confirm', event => {
            swal.fire({
                title: event.detail.title,
                text: event.detail.text,
                icon: event.detail.type,
                showCancelButton: true,
            }).then(res => {
                if (res.isConfirmed) {
                    window.livewire.emit('delete', event.detail.id)
                    swal.fire({
                        title: "Deleted",
                        text: 'Category Deleted Successfully!',
                        icon: 'success',
                    })
                }
            })
        });

        window.addEventListener('swal:confirmDeleteImage', event => {
            swal.fire({
                title: event.detail.title,
                text: event.detail.text,
                icon: event.detail.type,
                showCancelButton: true,
            }).then(res => {
                if (res.isConfirmed) {
                    window.livewire.emit('deleteImage', event.detail.id)
                    swal.fire({
                        title: "Deleted",
                        text: 'Image Deleted Successfully!',
                        icon: 'success',
                    })
                }
            })
        });

        window.addEventListener('swal:success', event => {
            swal.fire({
                title: event.detail.title,
                text: event.detail.text,
                icon: event.detail.type,
                // showCancelButton: true,
            })
        });
    </script>
    <!-- End of Javascript Part -->
</div>