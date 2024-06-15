<!-- music_management/categories.blade.php -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<!-- Include Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<!-- Include jQuery before Bootstrap -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


<x-app-layout>
<x-slot name="header">
    <div class="flex justify-between items-center my-8">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Category List') }}
        </h2>
        <div>
            <a href="{{ route('admin.settings') }}" class="btn btn-secondary">Back</a>
            @if (\App\Helpers\AccessRightsHelper::checkPermission('categories.create') === 'inline')
                <button id="addCategoryButton" data-toggle="modal" data-target="#addCategoryModal" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Category
                </button>
            @endif
            
        </div>
    </div>
</x-slot>


    <div class="py-12">
      
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                
            <div class="p-6">
                
                <div class="overflow-x-auto">
                    <div class="pagination flex justify-center items-center h-full" style="padding:0px;margin-bottom:10px;">
                        {{ $categories->links() }}
                    </div>
                    <table class="w-full max-w-full table-auto border divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 5%;" class="px-6 py-3 bg-gray-50 text-center font-bold text-s text-gray-500 uppercase tracking-wider">#</th>
                                <th scope="col" style="width: 85%;" class="px-6 py-3 bg-gray-50 text-center font-bold text-s text-gray-500 uppercase tracking-wider">Name</th>
                                <th scope="col" style="width: 10%;" class="px-6 py-3 bg-gray-50 text-center font-bold text-s text-gray-500 uppercase tracking-wider"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $index => $category)
                            <tr class="{{ $index % 2 == 0 ? 'bg-gray-50' : 'bg-white' }} hover:bg-gray-200">
                                <td style="width: 5%;" class="px-6 py-4 whitespace-nowrap border text-center">{{ ($categories->currentPage() - 1) * $categories->perPage() + $loop->iteration }}</td>
                                
                                <td style="width: 85%;" class="px-6 py-4 whitespace-nowrap border text-center">{{ $category->name }}</td>
                                <td style="width: 10%;" class="px-6 py-4 whitespace-nowrap border text-center">
                                @if (\App\Helpers\AccessRightsHelper::checkPermission('categories.edit') === 'inline')
                                    <button class="btn btn-secondary btn-sm edit-category" 
                                        data-toggle="modal" 
                                        data-target="#editCategoryModal" 
                                        data-id="{{ $category->id }}"
                                        data-name="{{ $category->name }}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    @endif

                                    @if (\App\Helpers\AccessRightsHelper::checkPermission('categories.delete') === 'inline')
                                        <button class="btn btn-secondary btn-sm delete-category" 
                                            data-category-id="{{ $category->id }}"
                                            data-category-name="{{ $category->name }}">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    @endif
                                </td>


                            </tr>
                            @endforeach
                        </tbody>
                    </table>





                    <div class="pagination flex justify-center items-center h-full" style="padding:0px;margin-top:10px;">
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>


            </div>
        </div>
    </div>


    <!-- Add Category Modal -->
    <div class="modal fade" data-backdrop="static" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCategoryModalLabel">Add Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('categories.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Category Name:</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Category</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


                <!-- Edit Category Modal -->
            <div class="modal fade" id="editCategoryModal" tabindex="-1" role="dialog" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editCategoryModalLabel">Edit Category</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                                
                        <form id="editForm" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="edit_name">Category Name:</label>
                                
                                <input type="hidden" class="form-control" id="edit_id" name="edit_id" value="{{ $category->id }}">
                                <input type="text" class="form-control" id="edit_name" name="edit_name" value="{{ $category->name }}" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </form>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Delete Category Modal -->
            <div class="modal fade" id="deleteCategoryModal" tabindex="-1" role="dialog" aria-labelledby="deleteCategoryModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteCategoryModalLabel">Delete Category</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete this category?</p>
                        </div>
                        <div class="modal-footer">
                            <form id="deleteCategoryForm" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                // JavaScript for handling the edit modal
                $('.edit-category').click(function() {
                    var categoryId = $(this).data('id');
                    var categoryName = $(this).data('name');
                
                    $('#edit_name').val(categoryName);
                        // Set the category ID in the form action
                        $('#editForm').attr('action', "{{ route('categories.update', ':id') }}".replace(':id', categoryId));
                });

                // JavaScript for handling the delete modal
                $('.delete-category').click(function() {
                    var categoryId = $(this).data('category-id');
                    var categoryName = $(this).data('category-name');
                    var form = $('#deleteCategoryForm');
                    var url = "{{ url('music_management/categories') }}/" + categoryId;
                    form.attr('action', url);
                    $('#deleteCategoryModal').modal('show');
                });

            </script>
    </x-app-layout>
