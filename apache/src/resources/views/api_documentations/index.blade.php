{{-- resources/views/api_documentations/index.blade.php --}}

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<!-- Include Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<!-- Include jQuery before Bootstrap -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- resources/views/admin/settings.blade.php -->

<x-app-layout>
    <x-slot name="header">
     
    <div class="flex justify-between items-center my-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('API Documentation') }}
            </h2>
            <div>
                <a href="{{ route('api_documentations.create') }}" class="btn btn-primary ml-3"><i class="fas fa-plus"></i> New Endpoint</a>
                
                <a href="{{ route('admin.settings') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </x-slot>




    <div class="py-12">
        <div class="container mx-auto sm:px-6 lg:px-8 mt-4">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="d-flex flex-wrap">
                    <table class="w-full max-w-full table-auto border divide-y divide-gray-200">
    <thead>
        <tr>
            <th scope="col" style="width: 5%;" class="px-6 py-3 bg-gray-50 text-center font-bold text-s text-gray-500 uppercase tracking-wider">ID</th>
            <th scope="col" style="width: 25%;" class="px-6 py-3 bg-gray-50 text-center font-bold text-s text-gray-500 uppercase tracking-wider">Endpoint</th>
            <th scope="col" style="width: 25%;" class="px-6 py-3 bg-gray-50 text-center font-bold text-s text-gray-500 uppercase tracking-wider">Description</th>
            <th scope="col" style="width: 25%;" class="px-6 py-3 bg-gray-50 text-center font-bold text-s text-gray-500 uppercase tracking-wider">View API</th>
            <th scope="col" style="width: 25%;" class="px-6 py-3 bg-gray-50 text-center font-bold text-s text-gray-500 uppercase tracking-wider">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($apiDocumentations as $apiDocumentation)
            <tr>
                <td class="px-6 py-1 whitespace-nowrap border text-center">{{ $loop->iteration }}</td>
                <td class="px-6 py-1 whitespace-nowrap border text-left endpoint">{{ $apiDocumentation->endpoint }}</td>
                <td class="px-6 py-1 whitespace-nowrap border text-left">{{ $apiDocumentation->description }}</td>
                <td class="px-6 py-1 whitespace-nowrap border text-center">
                    <a href="javascript:void(0);" class="view-icon">
                        <i class="fas fa-file-code"></i>
                    </a>
                </td>

                <td class="px-6 py-1 whitespace-nowrap border text-center">
                    <a href="{{ route('api_documentations.edit', $apiDocumentation->id) }}" class="btn btn-sm btn-secondary"><i class="fas fa-edit"></i></a>
                    <form action="{{ route('api_documentations.destroy', $apiDocumentation->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this?')"><i class="fas fa-trash-alt"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const eyeIcons = document.querySelectorAll('.fa-file-code');
    
    eyeIcons.forEach(icon => {
        icon.addEventListener('click', function() {
            const baseUrl = window.location.origin.trim(); // Trim to remove any leading/trailing spaces
            const endpointElement = this.closest('tr').querySelector('.endpoint');
            let endpoint = endpointElement.innerText.trim().replace(/^\/(?:GET|POST|PUT|DELETE)\s/, ''); // Trim to remove leading/trailing spaces and remove HTTP verb
            const placeholderRegex = /{([^}]*)}/;
            
            if (placeholderRegex.test(endpoint)) {
                const placeholder = placeholderRegex.exec(endpoint)[1];
                const value = prompt(`Enter value for ${placeholder}`);
                if (value !== null) {
                    const apiUrl = constructApiUrl(baseUrl, endpoint, value);
                    openInNewTab(apiUrl.replace('/GET', ''));
                }
            } else {
                const apiUrl = constructApiUrl(baseUrl, endpoint, '');
                openInNewTab(apiUrl.replace('/GET', ''));
            }
        });
    });
});

function constructApiUrl(baseUrl, endpoint, value) {
    let apiUrl = endpoint.replace(/{([^}]*)}/g, value).replace(/^\//, ''); // Remove leading '/' and replace placeholder with value

    return `${baseUrl}/${apiUrl}`; // Ensure correct concatenation with '/'
}

function openInNewTab(url) {
    var win = window.open(url, '_blank');
    win.focus();
}
</script>







    
</div>
</div>
</div>
</div>
</div>

</x-app-layout>
