<!-- music_management/credits.blade.php -->
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
                {{ __('Credits List') }}
            </h2>
            <div>
                <a href="{{ route('admin.settings') }}" class="btn btn-secondary">Back</a>
                @if (\App\Helpers\AccessRightsHelper::checkPermission('credits.create') == 'inline')
                    <button id="addCreditButton" data-toggle="modal" data-target="#addCreditModal" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Credit
                    </button>
                @endif
            </div>
        </div>
    </x-slot>

    <div class="py-12">


        <script>
            $(document).ready(function() {
                $('#searchCredit').on('keyup', function() {
                    var searchText = $(this).val().toLowerCase();
                    $('table tbody tr').each(function() {
                        var name = $(this).find('td:nth-child(2)').text().toLowerCase();
                        var district = $(this).find('td:nth-child(4)').text().toLowerCase();
                        var local = $(this).find('td:nth-child(5)').text().toLowerCase();
                        var designation = $(this).find('td:nth-child(7)').text().toLowerCase();
                        if (name.includes(searchText) || district.includes(searchText) || local.includes(searchText) || designation.includes(searchText)) {
                            $(this).show();
                        } else {
                            $(this).hide();
                        }
                    });
                });
            });
        </script>


      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                
            <div class="p-6">


                <form action="{{ route('credits.index') }}" method="GET" class="mt-4 mb-4">
                    <div class="input-group">
                        <input type="text" id="searchCredit" name="query" class="form-control" placeholder="Search credits by name, district, local, or designation">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-success">Search</button>
                        </div>
                    </div>
                </form>


                <div class="overflow-x-auto">
                    <div class="pagination flex justify-center items-center" style="padding:0px;margin-bottom:10px;">
                        {{ $credits->appends(['query' => request()->query('query')])->links() }}
                    </div>

                    <table class="w-full max-w-full table-auto border divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 5%;" class="px-6 py-3 bg-gray-50 text-center font-bold text-s text-gray-500 uppercase tracking-wider">#</th>
                                <th scope="col" style="width: 30%;" class="px-6 py-3 bg-gray-50 text-center font-bold text-s text-gray-500 uppercase tracking-wider">Name</th>
                                <th scope="col" style="width: 10%;" class="px-6 py-3 bg-gray-50 text-center font-bold text-s text-gray-500 uppercase tracking-wider">Local</th>
                                <th scope="col" style="width: 10%;" class="px-6 py-3 bg-gray-50 text-center font-bold text-s text-gray-500 uppercase tracking-wider">District</th>
                                <th scope="col" style="width: 15%;" class="px-6 py-3 bg-gray-50 text-center font-bold text-s text-gray-500 uppercase tracking-wider">Duty</th>
                                <th scope="col" style="width: 15%;" class="px-6 py-3 bg-gray-50 text-center font-bold text-s text-gray-500 uppercase tracking-wider">Birthday</th>
                                <th scope="col" style="width: 10%;" class="px-6 py-3 bg-gray-50 text-center font-bold text-s text-gray-500 uppercase tracking-wider">Music Background</th>
                                <th scope="col" style="width: 8%;" class="px-6 py-3 bg-gray-50 text-center font-bold text-s text-gray-500 uppercase tracking-wider">Designation</th>
                                
                                <th scope="col" style="width: 15%;" class="px-6 py-3 bg-gray-50 text-center font-bold text-s text-gray-500 uppercase tracking-wider"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($credits as $index => $credit)
                            <tr class="{{ $index % 2 == 0 ? 'bg-gray-50' : 'bg-white' }} hover:bg-gray-200">
                                <td style="width: 5%;" class="px-6 py-4 whitespace-nowrap border text-center">{{ ($credits->currentPage() - 1) * $credits->perPage() + $loop->iteration }}</td>
                                <td style="width: 30%;" class="px-6 py-4 whitespace-nowrap border text-center">{{ $credit->name }}</td>
                                <td style="width: 10%;" class="px-6 py-4 whitespace-nowrap border text-center">{{ $credit->local }}</td>
                                <td style="width: 10%;" class="px-6 py-4 whitespace-nowrap border text-center">{{ $credit->district }}</td>
                                <td style="width: 10%;" class="px-6 py-4 whitespace-nowrap border text-center">{{ $credit->duty }}</td>
                                <td style="width: 15%;" class="px-6 py-4 whitespace-nowrap border text-center">
                                    {{ $credit->birthday !== '0000-00-00 00:00:00' ? \Carbon\Carbon::parse($credit->birthday)->format('F j, Y') : '-' }}
                                </td>
                                <td style="width: 10%;" class="px-6 py-4 whitespace-nowrap border text-center">{{ $credit->music_background }}</td>
                           
                                <td style="width: 8%;" class="px-6 py-4 whitespace-nowrap border text-center">
                                    @if($credit->designation == 1)
                                        Arranger
                                    @elseif($credit->designation == 2)
                                        Composer
                                    @elseif($credit->designation == 3)
                                        Lyricist
                                    @else
                                        -
                                    @endif
                                </td>

                                <td style="width: 15%;" class="px-6 py-4 whitespace-nowrap border text-center">
                                    @if (\App\Helpers\AccessRightsHelper::checkPermission('credits.edit') == 'inline')
                                        <button class="btn btn-secondary btn-sm edit-Credit" 
                                            data-toggle="modal" 
                                            data-target="#editCreditModal" 
                                            data-id="{{ $credit->id }}"
                                            data-name="{{ $credit->name }}"
                                            data-birthday="{{ $credit->birthday }}"
                                            data-district="{{ $credit->district }}"
                                            data-local="{{ $credit->local }}"
                                            data-music_background="{{ $credit->music_background }}"
                                            data-designation="{{ $credit->designation }}"
                                            data-duty="{{ $credit->duty }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    @endif

                                    @if (\App\Helpers\AccessRightsHelper::checkPermission('credits.delete') == 'inline')
                                        <button class="btn btn-secondary btn-sm delete-Credit" 
                                            data-credit-id="{{ $credit->id }}"
                                            data-credit-name="{{ $credit->name }}">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="pagination flex justify-center items-center" style="padding:0px;margin-top:10px;">
                        {{ $credits->appends(['query' => request()->query('query')])->links() }}
                    </div>
                </div>
            </div>


            </div>
        </div>
    </div>


    <!-- Add Credit Modal -->
    <div class="modal fade" data-backdrop="static" id="addCreditModal" tabindex="-1" role="dialog" aria-labelledby="addCreditModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCreditModalLabel">Add Credit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('credits.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Credit Name:</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>

                        <div class="form-group">
                            <label for="local">Local:</label>
                            <input type="text" class="form-control" id="local" name="local" required>
                        </div>
                        <div class="form-group">
                            <label for="district">District:</label>
                            <input type="text" class="form-control" id="district" name="district" required>
                        </div>

                        <div class="form-group">
                            <label for="duty">Duty:</label>
                            <input type="text" class="form-control" id="duty" name="duty" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="birthday">Birthday:</label>
                            <input type="date" class="form-control" id="birthday" name="birthday" required>
                        </div>

                        <div class="form-group">
                            <label for="music_background">Music Background(Optional):</label>
                            <textarea type="text" class="form-control" id="music_background" name="music_background"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="designation">Designation:</label>
                            <select class="form-control" id="designation" name="designation" required>
                                <option value="0" selected disabled>Select Designation</option>
                                <option value="1">Arranger</option>
                                <option value="2">Composer</option>
                                <option value="3">Lyricist</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Add Credit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


                <!-- Edit Credit Modal -->
            <div class="modal fade" id="editCreditModal" tabindex="-1" role="dialog" aria-labelledby="editCreditModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editCreditModalLabel">Edit Credit</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                                
                        <form id="editForm" method="POST">
                            @csrf
                            @method('PUT')

                            <input type="hidden" class="form-control" id="edit_id" name="edit_id" value="{{ $credit->id }}">
                            <div class="form-group">
                                <label for="edit_name">Credit Name:</label>
                                
                                
                                <input type="text" class="form-control" id="edit_name" name="edit_name" value="{{ $credit->name }}" required>
                            </div>

                            <div class="form-group">
                                <label for="edit_local">Local:</label>
                                <input type="text" class="form-control" id="edit_local" name="edit_local" required>
                            </div>

                            <div class="form-group">
                                <label for="edit_district">District:</label>
                                <input type="text" class="form-control" id="edit_district" name="edit_district" required>
                            </div>

                            <div class="form-group">
                                <label for="edit_duty">Duty:</label>
                                <input type="text" class="form-control" id="edit_duty" name="edit_duty" required>
                            </div>

                            <div class="form-group">
                                <label for="edit_birthday">Birthday:</label>
                                <input type="date" class="form-control" id="edit_birthday" name="edit_birthday" required>
                            </div>

                            <div class="form-group">
                                <label for="edit_music_background">Music Background(Optional): </label>
                                <textarea type="text" class="form-control" id="edit_music_background" name="edit_music_background"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="edit_designation">Designation:</label>
                                <select class="form-control" id="edit_designation" name="edit_designation" required>
                                    <option value="0" selected disabled>Select Designation</option>
                                    <option value="1">Arranger</option>
                                    <option value="2">Composer</option>
                                    <option value="3">Lyricist</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </form>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Delete Credit Modal -->
            <div class="modal fade" id="deleteCreditModal" tabindex="-1" role="dialog" aria-labelledby="deleteCreditModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteCreditModalLabel">Delete Credit</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete this Credit?</p>
                        </div>
                        <div class="modal-footer">
                            <form id="deleteCreditForm" method="POST">
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
                $('.edit-Credit').click(function() {
                    var CreditId = $(this).data('id');
                    var CreditName = $(this).data('name');
                    var Local = $(this).data('local');
                    var District = $(this).data('district');
                    var Duty = $(this).data('duty');
                    var Birthday = $(this).data('birthday');
                    var MusicBackground = $(this).data('music_background');
                    var Designation = $(this).data('designation');
            
                    // Format the birthday value if it's not empty
                    if (Birthday !== '0000-00-00 00:00:00') {
                        // Convert birthday string to a Date object
                        var birthdayDate = new Date(Birthday);

                        // Adjust the date by adding one day
                        birthdayDate.setDate(birthdayDate.getDate() + 1);

                        // Format the adjusted date
                        var formattedBirthday = birthdayDate.toISOString().split('T')[0];
                    } else {
                        var formattedBirthday = ''; // Set an empty string if the birthday value is '0000-00-00 00:00:00'
                    }
                    
                    $('#edit_name').val(CreditName);
                    $('#edit_local').val(Local);
                    $('#edit_district').val(District);
                    $('#edit_duty').val(Duty);
                    $('#edit_birthday').val(formattedBirthday);
                    $('#edit_music_background').val(MusicBackground);
                    $('#edit_designation').val(Designation);

                    // Set the Credit ID in the form action
                    $('#editForm').attr('action', "{{ route('credits.update', ':id') }}".replace(':id', CreditId));
                });

                // JavaScript for handling the delete modal
                $('.delete-Credit').click(function() {
                    var CreditId = $(this).data('credit-id');
                    var CreditName = $(this).data('credit-name');
                    var form = $('#deleteCreditForm');
                    var url = "{{ url('music_management/credits') }}/" + CreditId;
                    form.attr('action', url);
                    $('#deleteCreditModal').modal('show');
                });

            </script>
    </x-app-layout>
