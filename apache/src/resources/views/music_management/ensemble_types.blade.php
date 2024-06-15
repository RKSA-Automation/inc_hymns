<!-- music_management/ensemble_types.blade.php -->
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
                {{ __('Ensemble Types List') }}
            </h2>
            <div>
                <a href="{{ route('admin.settings') }}" class="btn btn-secondary">Back</a>
                @if (\App\Helpers\AccessRightsHelper::checkPermission('ensemble_types.create') == 'inline')
                    <button id="addEnsemble_typeButton" data-toggle="modal" data-target="#addEnsemble_typeModal" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Ensemble Type
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
             
                    <table class="w-full max-w-full table-auto border divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 5%;" class="px-6 py-3 bg-gray-50 text-center font-bold text-s text-gray-500 uppercase tracking-wider">#</th>
                                <th scope="col" style="width: 85%;" class="px-6 py-3 bg-gray-50 text-center font-bold text-s text-gray-500 uppercase tracking-wider">Name</th>
                                <th scope="col" style="width: 10%;" class="px-6 py-3 bg-gray-50 text-center font-bold text-s text-gray-500 uppercase tracking-wider"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ensembletypes as $index => $ensemble_type)
                            <tr class="{{ $index % 2 == 0 ? 'bg-gray-50' : 'bg-white' }} hover:bg-gray-200">
                                <td style="width: 5%;" class="px-6 py-4 whitespace-nowrap border text-center">{{ $loop->iteration }}</td>
                                
                                <td style="width: 85%;" class="px-6 py-4 whitespace-nowrap border text-center">{{ $ensemble_type->name }}</td>
                                <td style="width: 15%;" class="px-6 py-4 whitespace-nowrap border text-center">
                                    @if (\App\Helpers\AccessRightsHelper::checkPermission('ensemble_types.edit') == 'inline')
                                        <button class="btn btn-secondary btn-sm edit-Ensemble_type" 
                                            data-toggle="modal" 
                                            data-target="#editEnsemble_typeModal" 
                                            data-id="{{ $ensemble_type->id }}"
                                            data-name="{{ $ensemble_type->name }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    @endif

                                    @if (\App\Helpers\AccessRightsHelper::checkPermission('ensemble_types.delete') == 'inline')
                                    <button class="btn btn-secondary btn-sm delete-Ensemble_type" 
                                        data-ensemble_type-id="{{ $ensemble_type->id }}"
                                        data-ensemble_type-name="{{ $ensemble_type->name }}">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                    @endif
                                </td>


                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                
                </div>
            </div>


            </div>
        </div>
    </div>


    <!-- Add Ensemble_type Modal -->
    <div class="modal fade" data-backdrop="static" id="addEnsemble_typeModal" tabindex="-1" role="dialog" aria-labelledby="addEnsemble_typeModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addEnsemble_typeModalLabel">Add Ensemble_type</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('ensemble_types.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Ensemble_type Name:</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Ensemble_type</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


                <!-- Edit Ensemble_type Modal -->
            <div class="modal fade" id="editEnsemble_typeModal" tabindex="-1" role="dialog" aria-labelledby="editEnsemble_typeModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editEnsemble_typeModalLabel">Edit Ensemble_type</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                                
                        <form id="editForm" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="edit_name">Ensemble_type Name:</label>
                                
                                <input type="hidden" class="form-control" id="edit_id" name="edit_id" value="{{ $ensemble_type->id }}">
                                <input type="text" class="form-control" id="edit_name" name="edit_name" value="{{ $ensemble_type->name }}" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </form>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Delete Ensemble_type Modal -->
            <div class="modal fade" id="deleteEnsemble_typeModal" tabindex="-1" role="dialog" aria-labelledby="deleteEnsemble_typeModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteEnsemble_typeModalLabel">Delete Ensemble_type</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete this Ensemble_type?</p>
                        </div>
                        <div class="modal-footer">
                            <form id="deleteEnsemble_typeForm" method="POST">
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
                $('.edit-Ensemble_type').click(function() {
                    var ensemble_typeId = $(this).data('id');
                    var ensemble_typeName = $(this).data('name');
                
                    $('#edit_name').val(ensemble_typeName);
                        // Set the Ensemble_type ID in the form action
                        $('#editForm').attr('action', "{{ route('ensemble_types.update', ':id') }}".replace(':id', ensemble_typeId));
                });

                // JavaScript for handling the delete modal
                $('.delete-Ensemble_type').click(function() {
                    var ensemble_typeId = $(this).data('ensemble_type-id');
                    var ensemble_typeName = $(this).data('ensemble_type-name');
                    var form = $('#deleteEnsemble_typeForm');
                    var url = "{{ url('music_management/ensemble_types') }}/" + ensemble_typeId;
                    form.attr('action', url);
                    $('#deleteEnsemble_typeModal').modal('show');
                });

            </script>
    </x-app-layout>
