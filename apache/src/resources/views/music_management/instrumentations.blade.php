<!-- music_management/instrumentations.blade.php -->
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
                {{ __('Instrumentation List') }}
            </h2>
            <div>
                <a href="{{ route('admin.settings') }}" class="btn btn-secondary">Back</a>
                @if (\App\Helpers\AccessRightsHelper::checkPermission('instrumentations.create') === 'inline')
                    <button id="addInstrumentationButton" data-toggle="modal" data-target="#addInstrumentationModal" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Instrumentation
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
                            @foreach($instrumentations as $index => $instrumentation)
                            <tr class="{{ $index % 2 == 0 ? 'bg-gray-50' : 'bg-white' }} hover:bg-gray-200">
                                <td style="width: 5%;" class="px-6 py-4 whitespace-nowrap border text-center">{{ $loop->iteration }}</td>
                                
                                <td style="width: 85%;" class="px-6 py-4 whitespace-nowrap border text-center">{{ $instrumentation->name }}</td>
                                <td style="width: 15%;" class="px-6 py-4 whitespace-nowrap border text-center">
                                    @if (\App\Helpers\AccessRightsHelper::checkPermission('instrumentations.edit') == 'inline')
                                        <button class="btn btn-secondary btn-sm edit-Instrumentation" 
                                            data-toggle="modal" 
                                            data-target="#editInstrumentationModal" 
                                            data-id="{{ $instrumentation->id }}"
                                            data-name="{{ $instrumentation->name }}">
                                            
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    @endif

                                    @if (\App\Helpers\AccessRightsHelper::checkPermission('instrumentations.delete') == 'inline')
                                        <button class="btn btn-secondary btn-sm delete-Instrumentation" 
                                            data-Instrumentation-id="{{ $instrumentation->id }}"
                                            data-Instrumentation-name="{{ $instrumentation->name }}">
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


    <!-- Add Instrumentation Modal -->
    <div class="modal fade" data-backdrop="static" id="addInstrumentationModal" tabindex="-1" role="dialog" aria-labelledby="addInstrumentationModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addInstrumentationModalLabel">Add Instrumentation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('instrumentations.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Instrumentation Name:</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Instrumentation</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


                <!-- Edit Instrumentation Modal -->
            <div class="modal fade" id="editInstrumentationModal" tabindex="-1" role="dialog" aria-labelledby="editInstrumentationModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editInstrumentationModalLabel">Edit Instrumentation</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                                
                        <form id="editForm" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="edit_name">Instrumentation Name:</label>
                                
                                <input type="hidden" class="form-control" id="edit_id" name="edit_id" value="{{ $instrumentation->id }}">
                                <input type="text" class="form-control" id="edit_name" name="edit_name" value="{{ $instrumentation->name }}" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </form>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Delete Instrumentation Modal -->
            <div class="modal fade" id="deleteInstrumentationModal" tabindex="-1" role="dialog" aria-labelledby="deleteInstrumentationModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteInstrumentationModalLabel">Delete Instrumentation</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete this Instrumentation?</p>
                        </div>
                        <div class="modal-footer">
                            <form id="deleteInstrumentationForm" method="POST">
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
                $('.edit-Instrumentation').click(function() {
                    var InstrumentationId = $(this).data('id');
                    var InstrumentationName = $(this).data('name');
                
                    $('#edit_name').val(InstrumentationName);
                        // Set the Instrumentation ID in the form action
                        $('#editForm').attr('action', "{{ route('instrumentations.update', ':id') }}".replace(':id', InstrumentationId));
                });

                // JavaScript for handling the delete modal
                $('.delete-Instrumentation').click(function() {
                    var InstrumentationId = $(this).data('instrumentation-id');
                    var InstrumentationName = $(this).data('instrumentation-name');
                    var form = $('#deleteInstrumentationForm');
                    var url = "{{ url('music_management/instrumentations') }}/" + InstrumentationId;
                    form.attr('action', url);
                    $('#deleteInstrumentationModal').modal('show');
                });

            </script>
    </x-app-layout>
