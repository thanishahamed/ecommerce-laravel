<div>
    <div class="card">
        <div class="card-body">
            <h1> Manage Discounts </h1>
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
                            Add Discount
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

            <!-- Modal Add Discount-->
            <div wire:ignore.self class="modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" align="center" id="exampleModalLabel">Add a discount!</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h1> Add Discount </h1>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="name"> Dicount Name: </label>
                                        <input class="form-control" id="name" type="text" wire:model="name" placeholder="Enter product name">
                                        @if($errors->has('name'))
                                        <div class="text-danger text-strong"> {{$errors->first('name')}} </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="desc"> Description: </label>
                                        <textarea class="form-control" id="desc" wire:model="description" placeholder="Brief description about the product"></textarea>
                                        @if($errors->has('description'))
                                        <div class="text-danger"> {{$errors->first('description')}} </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="name"> Dicount Percentage (eg: 0.5 = 5%): </label>
                                        <input class="form-control" id="name" type="number" wire:model="discount_percent" placeholder="Enter product name">
                                        @if($errors->has('discount_percent'))
                                        <div class="text-danger text-strong"> {{$errors->first('discount_percent')}} </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="name"> Stock Status: @if($discountStatus !== "") <span class="text-success"> Selected </span> @endif</label>
                                        <select class="form-control form-control-sm" wire:model="discountStatus">
                                            <option value="">Select</option>
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                        @if($errors->has('productCategoryId'))
                                        <div class="text-danger text-strong"> {{$errors->first('productCategoryId')}} </div>
                                        @endif
                                    </div>
                                    <button type="button" class="btn btn-primary pull-right" id="addButton" wire:click="save">SAVE</button>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">§
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Edit Discount -->
            <div wire:ignore.self class="modal" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" align="center" id="exampleModalLabel">Add a discount!</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h1> Add Discount </h1>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="name"> Dicount Name: </label>
                                        <input class="form-control" id="name" type="text" wire:model="name" placeholder="Enter product name">
                                        @if($errors->has('name'))
                                        <div class="text-danger text-strong"> {{$errors->first('name')}} </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="desc"> Description: </label>
                                        <textarea class="form-control" id="desc" wire:model="description" placeholder="Brief description about the product"></textarea>
                                        @if($errors->has('description'))
                                        <div class="text-danger"> {{$errors->first('description')}} </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="name"> Dicount Percentage (eg: 0.5 = 5%): </label>
                                        <input class="form-control" id="name" type="number" wire:model="discount_percent" placeholder="Enter product name">
                                        @if($errors->has('discount_percent'))
                                        <div class="text-danger text-strong"> {{$errors->first('discount_percent')}} </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="name"> Stock Status: @if($discountStatus !== "") <span class="text-success"> Selected </span> @endif</label>
                                        <select class="form-control form-control-sm" wire:model="discountStatus">
                                            <option value="">Select</option>
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                        @if($errors->has('discountStatus'))
                                        <div class="text-danger text-strong"> {{$errors->first('discountStatus')}} </div>
                                        @endif
                                    </div>
                                    <button type="button" class="btn btn-primary pull-right" wire:click="update">UPDATE</button>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">§
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
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Dicount %</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($items as $item)
                        <tr class="align-middle">
                            <td>{{$item->id}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->description}}</td>
                            <td>{{$item->discount_percent}}</td>
                            <td>{{$item->active === 1 ? "Active" : "Inactive"}}</td>
                            <td>{{$item->created_at}}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                    <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#editModal" wire:click="prepareEdit({{$item->id}})">Edit</button>
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
                        text: 'Discount Deleted Successfully!',
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