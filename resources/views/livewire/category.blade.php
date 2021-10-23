<div>
    <div class="card">
        <div class="card-body">
            <h1> Manage Categories </h1>

            <div class="lds-ellipsis" wire:loading.delay>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>

            <div class="d-flex justify-content-evenly">
                <input type="text" class="form-control" wire:model="searchString" placeholder="Search By Names">
                <!-- Category Add Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Add Category
                </button>
            </div>



            <!-- Modal -->
            <div class="modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h1> Add Category </h1>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-info" data-dismiss="modal">Reset</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="overflow-auto" style="min-height: 450px; max-height: 450px; max-width: 700px;">
                <table class="table table-striped border datatable">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Description</th>
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
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($categories as $category)
                        <tr class="align-middle">
                            <td>{{$category->id}}</td>
                            <td>{{$category->name}}</td>
                            <td>{{$category->id}}</td>
                            <td>{{$category->status}}</td>
                            <td>{{$category->created_at}}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                    <!-- <button type="button" class="btn btn-outline-info">View</button> -->
                                    <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#exampleModal">Edit</button>
                                    <button type="button" class="btn btn-outline-danger" wire:click="confirmDelete({{$category->id}})">Delete</button>
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

            <template id="my-template">
                <swal-title>
                    Save changes to "Untitled 1" before closing?
                </swal-title>
                <swal-icon type="warning" color="red"></swal-icon>
                <swal-button type="confirm">
                    Save As
                </swal-button>
                <swal-button type="cancel">
                    Cancel
                </swal-button>
                <swal-button type="deny">
                    Close without Saving
                </swal-button>
                <swal-param name="allowEscapeKey" value="false" />
                <swal-param name="customClass" value='{ "popup": "my-popup" }' />
            </template>

        </div>
    </div>
    <script>
        function startTest() {
            Swal.fire({
                title: 'Do you want to delete this file?',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'Save',
                denyButtonText: `Don't save`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    Swal.fire('Saved!', '', 'success')
                } else if (result.isDenied) {
                    Swal.fire('Record not deleted!', '', 'info')
                }
            })
        }

        window.addEventListener('swal:confirm', event => {
            swal.fire({
                title: event.detail.title,
                text: event.detail.text,
                icon: event.detail.type,
                showCancelButton: true,
            }).then(res => {
                if (res.isConfirmed) {
                    window.livewire.emit('deleteCategory', event.detail.id)
                    swal.fire({
                        title: "Deleted",
                        text: 'Category Deleted Successfully!',
                        icon: 'success',
                    })
                }
            })
        });
    </script>
</div>