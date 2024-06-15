<!-- resources/views/permissions/index.blade.php -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<!-- Include Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<!-- Include jQuery before Bootstrap -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Categories') }}
        </h2>
    </x-slot>

    <x-slot name="header">
        <div class="flex justify-between items-center my-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Activity Logs') }}
            </h2>
            <div>
               
                <a href="{{ route('admin.settings') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </x-slot>


    <div class="py-12 mt-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
       
                <div class="card">
        <div class="card-body">
            <p><strong>User:</strong> {{ optional($log->user)->name }}</p>
            <p><strong>Action:</strong> {{ $log->action }}</p>
            <p><strong>Model:</strong> {{ $log->model }}</p>
            <p><strong>Model ID:</strong> {{ $log->model_id }}</p>
            <p><strong>Changes:</strong> {{ $log->changes }}</p>
            <p><strong>IP Address:</strong> {{ $log->ip_address }}</p>
            <p><strong>User Agent:</strong> {{ $log->user_agent }}</p>
            <p><strong>Date:</strong> {{ $log->created_at }}</p>
        </div>
    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>


