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
            {{ !empty($group->name) ? $group->name : 'Current' }} Users
        </h2>

            <div>
         
                @php
                    // Get the current URL
                    $currentUrl = url()->current();

                    // Determine the route based on the presence of "groups" in the URL
                    $cancelRoute = str_contains($currentUrl, 'groups') ? route('groups.index') : route('admin.settings');
                    $displayRoute = str_contains($currentUrl, 'groups') ? route('groups.create') : route('users.create');
                    $displayLabel = str_contains($currentUrl, 'groups') ? 'Edit Group' : 'New User';
                    $displayIcon = str_contains($currentUrl, 'groups') ? 'fas fa-edit' : 'fas fa-plus';
                @endphp

                <a href="{{ $displayRoute }}" class="btn btn-primary ml-3"><i class="{{ $displayIcon }}"></i> {{ $displayLabel }}</a>

                <a href="{{ $cancelRoute }}" class="btn btn-secondary">
                    {{ __('Back') }}
                </a>

            </div>
        </div>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if(session('success'))
                        <div class="mb-4 font-medium text-sm text-green-600">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="w-full max-w-full table-auto border divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 5%;" class="px-6 py-3 bg-gray-50 text-center font-bold text-s text-gray-500 uppercase tracking-wider">#</th>
                                    <th scope="col" style="width: 20%;" class="px-6 py-3 bg-gray-50 text-center font-bold text-s text-gray-500 uppercase tracking-wider">Name</th>
                                    <th scope="col" style="width: 20%;" class="px-6 py-3 bg-gray-50 text-center font-bold text-s text-gray-500 uppercase tracking-wider">Email</th>
                                    <th scope="col" style="width: 15%;" class="px-6 py-3 bg-gray-50 text-center font-bold text-s text-gray-500 uppercase tracking-wider">Username</th>
                                    <th scope="col" style="width: 10%;" class="px-6 py-3 bg-gray-50 text-center font-bold text-s text-gray-500 uppercase tracking-wider">Activated</th>
                                    <th scope="col" style="width: 20%;" class="px-6 py-3 bg-gray-50 text-center font-bold text-s text-gray-500 uppercase tracking-wider">Group</th>
                                    <th scope="col" style="width: 10%;" class="px-6 py-3 bg-gray-50 text-center font-bold text-s text-gray-500 uppercase tracking-wider"></th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($users as $user)
                                    <tr>
                                        <td style="width: 5%;" class="px-6 py-1 whitespace-nowrap border text-center">{{ $loop->iteration }}</td>
                                        <td class="px-6 py-1 whitespace-nowrap border text-center">{{ $user->name }}</td>
                                        <td class="px-6 py-1 whitespace-nowrap border text-center">{{ $user->email }}</td>
                                        <td class="px-6 py-1 whitespace-nowrap border text-center">{{ $user->username }}</td>
                                        <td class="px-6 py-1 whitespace-nowrap border text-center">{{ $user->activated ? 'Yes' : 'No' }}</td>
                                        <td class="px-6 py-1 whitespace-nowrap border text-center">
                                            @if($user->groups->isEmpty())
                                                Current
                                            @else
                                                @foreach($user->groups as $group)
                                                    {{ $group->name }}
                                                    @if(!$loop->last), @endif
                                                @endforeach
                                            @endif
                                        </td>
                                        <td class="px-6 py-1 whitespace-nowrap border text-center">
                                            <div class="flex justify-center items-center space-x-2">
                                                @php
                                                    $url = url()->current();
                                                    $group_id = null;
                                                    if (Str::contains($url, 'groups') && Str::contains($url, 'users')) {
                                                        $segments = explode('/', $url);
                                                        $group_index = array_search('groups', $segments);
                                                        $user_index = array_search('users', $segments);
                                                        if ($group_index !== false && $user_index !== false && $group_index < $user_index) {
                                                            $group_id = $segments[$group_index + 1];
                                                        }
                                                    }
                                                @endphp
                                                <a href="{{ isset($group_id) ? route('users.edit', ['user' => $user->id, 'group' => $group_id]) : route('users.edit', ['user' => $user->id]) }}" class="btn btn-secondary btn-sm edit-Credit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirmDelete(event)">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded" style="margin-top:16px;margin-left:5px;">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                <script>
                    function confirmDelete(event) {
                        event.preventDefault(); // Prevent the form from submitting immediately
                        if (confirm('Are you sure you want to delete this user?')) {
                            event.target.submit(); // Submit the form if the user confirms
                        }
                    }
                </script>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>