<!-- resources/views/musics.blade.php -->
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
            {{ __('INC Hymn List') }}
        </h2>
        <div>

       

        <a href="{{ route('dashboard') }}" class="btn btn-secondary">Back</a>
        <button id="addMusicButton" class="btn btn-primary mb-0" style="display: {{ \App\Helpers\AccessRightsHelper::checkPermission('musics.create') }}">
            <i class="fas fa-plus"></i>
            <span> Music</span>
        </button>
        

       
        </div>
    </div>
    
    </x-slot>

    <div class="py-12">
      
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


    <script>
        // Add event listener to the addMusicButton
        document.getElementById('addMusicButton').addEventListener('click', function() {
            // Redirect to the music.create route (adjust the URL as needed)
            window.location.href = '{{ route("musics.create") }}';
        });
    </script>
    
    <!-- Dark overlay -->
    <div id="overlay" class="fixed top-0 left-0 w-screen h-screen bg-black bg-opacity-50 z-50 hidden"></div>

        <!-- Search Input and Tabs -->
        <form action="{{ route('musics.index') }}" method="GET" class="mt-4 mb-4">
            <div class="flex items-center justify-between mb-4">
                <form method="GET" action="{{ route('musics.index') }}" method="GET" class="mt-4 mb-4">
                <input type="text" id="searchInput" name="query" class="form-control rounded-md" value="{{ request('query') }}" placeholder="Search hymns ..." onkeypress="handleEnterKey(event)">
            
            <!-- Language Dropdown -->
            <select name="language_id" id="languageDropdown" class="rounded-md" style="height:38px;margin-left:2px;margin-right:2px;" onkeypress="handleDropdownEnterKey(event, 'searchForm')">
                <option value="All" {{ request('language_id') == 'All' ? 'selected' : '' }}>All languages</option>
                @foreach($languages as $language)
                    <option value="{{ $language->id }}" {{ request('language_id') == $language->id ? 'selected' : '' }}>
                        {{ $language->name }}
                    </option>
                @endforeach
            </select>
            
            <!-- Category Dropdown -->
            <select name="category_ids[]" id="categoryDropdown" class="rounded-md" style="height:38px;margin-left:2px;margin-right:2px;" onkeypress="handleDropdownEnterKey(event, 'searchForm')">
                <option value="All" {{ in_array('All', request('category_ids', [])) ? 'selected' : '' }}>All categories</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ in_array($category->id, request('category_ids', [])) ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
                    
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary" id="searchButton">Search</button>
                    </div>
                </form>

                <!-- Tabs -->
                <div class="flex" style="display:none;">
                    <button id="tabAll" class="tab-button bg-gray-200 hover:bg-gray-300 text-gray-700 py-2 px-4 rounded-l focus:outline-none">All</button>
                    <button id="tabSongs" class="tab-button bg-gray-200 hover:bg-gray-300 text-gray-700 py-2 px-4 focus:outline-none">Hymns</button>
                    <button id="tabPlaylist" class="tab-button bg-gray-200 hover:bg-gray-300 text-gray-700 py-2 px-4 rounded-r focus:outline-none">Playlist</button>
                </div>
            </div>
            <script>
    // Function to handle keypress event for input field
    function handleEnterKey(event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            document.getElementById("searchForm").submit();
        }
    }

    // Function to handle keypress event for dropdowns
    function handleDropdownEnterKey(event, formId) {
        if (event.keyCode === 13) {
            event.preventDefault();
            document.getElementById(formId).submit();
        }
    }
</script>
        </form>

        

        <style>
            #context-menu {
                display: none;
                position: fixed;
                top: 50%;
                left: -100%; /* Start off-screen */
                transform: translateY(-50%);
                background-color: #f9f9f9;
                padding: 8px 16px;
                border: 1px solid #ccc;
                z-index: 9999; /* Ensure menu appears above other content */
                width: 80%;
                max-width: 1200px;
                max-height: 80vh; /* Set maximum height to 80% of viewport height */
                overflow-y: auto; /* Enable vertical scrollbar if content overflows */
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                transition: left 0.3s ease-in-out; /* Smooth transition */
            }

            #context-menu.visible {
                left: 50%;
                transform: translate(-50%, -50%);
            }

            #categoriesSection {
                max-height: 70vh; /* Set maximum height to 70% of viewport height */
                overflow-y: auto; /* Enable vertical scrollbar if content overflows */
            }
        </style>

<!-- Categories Section -->
<div id="context-menu" class="mb-4 mx-auto">
    <div id="categoriesSection">
        <h2 class="text-lg font-semibold mb-2">Categories</h2>
        <div id="topCategories" class="flex flex-wrap -mx-2">
            @foreach($topCategories as $index => $category)
                <div class="w-1/2 md:w-1/5 px-2 mb-4">
                    <button id="categoryButton{{ $index }}" style="background-color:#686D76; height:150px; width:150px; border: 2px solid #00215E; border-radius: 0.5rem;" class="category-box bg-teal-400 hover:bg-teal-500 p-2 rounded text-center w-full" data-category-id="{{ $category->id }}" onclick="selectCategory({{ $index }})">
                        <span class="flex items-center justify-center h-full text-white">{{ $category->name }} ({{ $category->musics_count }})</span>
                    </button>
                </div>
            @endforeach
        </div>
        <button id="hideCategories" class="mt-4 text-blue-500 hidden">Hide</button>
        <div id="allCategories" class="hidden mt-4 flex flex-wrap -mx-2">
            @foreach($categories as $index => $category)
                @if($index >= 10) <!-- Start displaying from the 11th category -->
                    <div class="w-1/2 md:w-1/5 px-2 mb-4">
                        <button id="categoryButton{{ $index }}" style="background-color:#686D76; height:150px;width:150px; border: 2px solid #00215E; border-radius: 0.5rem;" class="category-box border border-teal-400 hover:border-teal-500 bg-teal-400 hover:bg-teal-500 p-2 rounded text-center w-full" data-category-id="{{ $category->id }}" onclick="selectCategory({{ $index }})">
                            <span class="flex items-center justify-center h-full text-white">{{ $category->name }} ({{ $category->musics_count }})</span>
                        </button>
                    </div>
                @endif
            @endforeach
        </div>
        <button id="viewAllCategories" class="mt-4 text-blue-500">View All</button>
    </div>
</div>

<script>
    let selectedCategoryId = null;

    function selectCategory(index) {
        if (selectedCategoryId !== null) {
            document.getElementById('categoryButton' + selectedCategoryId).style.backgroundColor = '#686D76';
        }
        selectedCategoryId = index;
        document.getElementById('categoryButton' + index).style.backgroundColor = '#373A40';

        // Hide the context menu
        const contextMenu = document.getElementById('context-menu');
        contextMenu.classList.remove('visible');
        setTimeout(() => {
            contextMenu.style.display = 'none';
        }, 300);
        categoriesSection.classList.add('hidden');

        // Reset the button icon
        const showCategoriesBtn = document.getElementById('showCategoriesModal');
        showCategoriesBtn.innerHTML = '<i class="fas fa-bars"></i>';
    }

    document.addEventListener('DOMContentLoaded', function() {
        const viewAllCategoriesBtn = document.getElementById('viewAllCategories');
        const hideCategoriesBtn = document.getElementById('hideCategories');
        const allCategoriesDiv = document.getElementById('allCategories');
        const showCategoriesBtn = document.getElementById('showCategoriesModal');
        const contextMenu = document.getElementById('context-menu');
        const categoriesSection = document.getElementById('categoriesSection');

        viewAllCategoriesBtn.addEventListener('click', function() {
            allCategoriesDiv.classList.remove('hidden');
            viewAllCategoriesBtn.classList.add('hidden');
            hideCategoriesBtn.classList.remove('hidden');
        });

        showCategoriesBtn.addEventListener('click', function() {
            if (contextMenu.classList.contains('visible')) {
                contextMenu.classList.remove('visible');
                setTimeout(() => {
                    contextMenu.style.display = 'none';
                }, 300); // Allow time for the slide-out transition
                categoriesSection.classList.add('hidden');
            } else {
                contextMenu.style.display = 'block';
                setTimeout(() => {
                    contextMenu.classList.add('visible');
                }, 0); // Allow time for the display to take effect
                categoriesSection.classList.remove('hidden');
            }
            showCategoriesBtn.innerHTML = contextMenu.classList.contains('visible') ? '<i class="fas fa-times"></i>' : '<i class="fas fa-bars"></i>'; // Toggle icon between close and menu
        });

        hideCategoriesBtn.addEventListener('click', function() {
            allCategoriesDiv.classList.add('hidden');
            hideCategoriesBtn.classList.add('hidden');
            viewAllCategoriesBtn.classList.remove('hidden');
        });

        const categoryBoxes = document.querySelectorAll('.category-box');

        categoryBoxes.forEach(box => {
            box.addEventListener('click', function() {
                const categoryId = this.getAttribute('data-category-id');
                fetchMusicsByCategory(categoryId);
            });
        });

        function fetchMusicsByCategory(categoryId) {
            const url = new URL(window.location.href);
            url.searchParams.set('category_ids[]', categoryId);

            fetch(url)
                .then(response => response.text())
                .then(html => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    const musicList = doc.getElementById('musicList');
                    document.getElementById('musicList').innerHTML = musicList.innerHTML;
                    document.querySelector('.pagination').innerHTML = doc.querySelector('.pagination').innerHTML;
                });
        }
    });
</script>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                <div class="pagination flex justify-center items-center" style="padding:0px;margin-bottom:10px;">
                        {{ $musics->appends(['query' => request()->query('query')])->links() }}
                    </div>
                    <!-- Music Table -->
                    <div class="overflow-x-auto">
                    <table class="min-w-full">
    <thead>
        <tr style="display:none;">
            <th scope="col" class="px-4 py-2 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
            <th style="width: 35% !important; white-space: normal;" scope="col" class="px-4 py-2 bg-gray-50 text-left text-s font-large text-black-500 uppercase tracking-wider" onclick="sortTable(1)">
                Title <i id="titleSortIcon" class="fas fa-sort"></i>
            </th>
            <th style="width: 18% !important; white-space: normal;" scope="col" class="px-4 py-2 bg-gray-50 text-center text-s font-large text-black-500 uppercase tracking-wider" onclick="sortTable(2)">
                Hymn # <i id="hymnSortIcon" class="fas fa-sort"></i>
            </th>
            <th style="width: 25% !important; white-space: normal;" scope="col" class="px-4 py-2 bg-gray-50 text-left text-s font-large text-black-500 uppercase tracking-wider">Category</th>
            <th style="width: 15% !important; white-space: normal;" scope="col" class="px-4 py-2 bg-gray-50 text-left text-s font-large text-black-500 uppercase tracking-wider">Language</th>
            @if (\App\Helpers\AccessRightsHelper::checkPermission('musics.action') == 'inline')
                <th scope="col" class="px-4 py-2 bg-gray-50 text-center text-s font-large text-black-500 uppercase tracking-wider">Action</th>
            @endif
        </tr>
    </thead>
    <tbody id="musicList" class="bg-white divide-y divide-gray-200">
        @foreach($musics as $index => $music)
        <tr class="hoverable">
            <td style="width: 5%;" class="px-4 py-3 whitespace-nowrap text-center">{{ ($musics->currentPage() - 1) * $musics->perPage() + $loop->iteration }}</td>
            <td style="width: 35% !important; white-space: normal;" class="px-4 py-3 whitespace-nowrap">
                <a href="{{ route('musics.show', $music->id) }}" class="flex items-center">
                    <i class="fas fa-music" style="margin-right: 12px; margin-left: 4px;color:#50727B;"></i>
                    {{ $music->title }}
                </a>
            </td>
            <td style="width: 18% !important; white-space: normal;" class="px-4 py-3 whitespace-nowrap text-left">
                {{ $music->song_number }}
            </td>
            <td style="width: 25% !important; white-space: normal;" class="px-4 py-3 whitespace-normal">
                @foreach($music->categories as $category)
                    {{ $loop->first ? '' : ', ' }}{{ $category->name }}
                @endforeach
            </td>
            <td style="width: 15% !important; white-space: normal;" class="px-4 py-3 whitespace-nowrap">
                {{ $music->language->name }}
            </td>
            @if (\App\Helpers\AccessRightsHelper::checkPermission('musics.action') == 'inline')
                <td class="px-4 py-3 whitespace-nowrap text-center">
                    <div class="flex justify-center items-center space-x-4">
                        @if (\App\Helpers\AccessRightsHelper::checkPermission('musics.edit') == 'inline')
                            <a href="{{ route('musics.edit', $music->id) }}" class="btn btn-secondary">
                                <i class="fas fa-edit"></i>
                            </a>
                        @endif

                        @if (\App\Helpers\AccessRightsHelper::checkPermission('musics.delete') == 'inline')
                            <form id="deleteForm{{$music->id}}" method="POST" action="{{ route('musics.destroy', $music->id) }}" style="display: inline;margin-top:16px;margin-left:3px;">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="confirmDelete({{$music->id}})" class="btn btn-secondary">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        @endif
                    </div>
                </td>
            @endif
        </tr>
        @endforeach
    </tbody>
</table>


<style>
    .hoverable:hover {
    background-color: #007bff; /* or any other color you prefer */
}

tbody tr:hover {
    background-color: #007bff; /* or any other color you prefer */   
    color: #ffffff; /* or any other color you prefer */
    font-weight:bold;
    font-size:17px;
}
</style>
<script>
    function confirmDelete(musicId) {
        if (confirm("Are you sure you want to delete this music entry?")) {
            document.getElementById('deleteForm' + musicId).submit();
        }
    }
</script>



                <script>
                var titleSortDirection = 1;
                var hymnSortDirection = 1;

                function sortTable(colIndex) {
                    var table, rows, switching, i, x, y, shouldSwitch;
                    table = document.querySelector('.min-w-full');
                    switching = true;
                    while (switching) {
                        switching = false;
                        rows = table.rows;
                        for (i = 1; i < (rows.length - 1); i++) {
                            shouldSwitch = false;
                            x = rows[i].getElementsByTagName("TD")[colIndex];
                            y = rows[i + 1].getElementsByTagName("TD")[colIndex];
                            var xValue = x.textContent || x.innerText;
                            var yValue = y.textContent || y.innerText;
                            if (colIndex === 1) {
                                if (titleSortDirection === 1) {
                                    if (xValue.toLowerCase() > yValue.toLowerCase()) {
                                        shouldSwitch = true;
                                        break;
                                    }
                                } else {
                                    if (xValue.toLowerCase() < yValue.toLowerCase()) {
                                        shouldSwitch = true;
                                        break;
                                    }
                                }
                            } else if (colIndex === 2) {
                                if (hymnSortDirection === 1) {
                                    if (parseInt(xValue) > parseInt(yValue)) {
                                        shouldSwitch = true;
                                        break;
                                    }
                                } else {
                                    if (parseInt(xValue) < parseInt(yValue)) {
                                        shouldSwitch = true;
                                        break;
                                    }
                                }
                            }
                        }
                        if (shouldSwitch) {
                            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                            switching = true;
                        }
                    }
                    toggleSortIcon(colIndex);
                }

                function toggleSortIcon(colIndex) {
                    var iconId = colIndex === 1 ? 'titleSortIcon' : 'hymnSortIcon';
                    var icon = document.getElementById(iconId);
                    if (icon.classList.contains('fa-sort')) {
                        icon.classList.remove('fa-sort');
                        icon.classList.add('fa-sort-up');
                        if (colIndex === 1) {
                            titleSortDirection = 1;
                        } else if (colIndex === 2) {
                            hymnSortDirection = 1;
                        }
                    } else if (icon.classList.contains('fa-sort-up')) {
                        icon.classList.remove('fa-sort-up');
                        icon.classList.add('fa-sort-down');
                        if (colIndex === 1) {
                            titleSortDirection = -1;
                        } else if (colIndex === 2) {
                            hymnSortDirection = -1;
                        }
                    } else if (icon.classList.contains('fa-sort-down')) {
                        icon.classList.remove('fa-sort-down');
                        icon.classList.add('fa-sort-up');
                        if (colIndex === 1) {
                            titleSortDirection = 1;
                        } else if (colIndex === 2) {
                            hymnSortDirection = 1;
                        }
                    }
                }
                </script>

                    <!-- Add this script to ensure FontAwesome icons are loaded -->
                    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

                    </div>
                    <div class="pagination flex justify-center items-center" style="padding:0px;margin-top:10px;">
                        {{ $musics->appends(['query' => request()->query('query')])->links() }}
                    </div>
                    <!-- Message when no music is found -->
                    <p id="noMusicFoundMessage" class="text-center text-gray-500 mt-4" style="display: none;">No music found</p>
                </div>
            </div>
            <style>
                /* Ensure table fills its container */
                table {
                    width: 100%;
                }

                /* Set minimum width to prevent shrinking */
                .min-w-full {
                    min-width: 100%;
                }

                /* Allow horizontal scrolling on overflow */
                .overflow-x-auto {
                    overflow-x: auto;
                }

                /* Style for active tab */
                .tab-button.active {
                    background-color: #3182ce;
                    color: white;
                }
                    /* Hover effect for table rows */
                tbody tr:hover {
                    background-color: #f3f4f6; /* Light gray background on hover */
                }
            </style>
            <script>
                // Add event listener for search input
                document.getElementById('searchInput').addEventListener('input', function() {
                    const searchTerm = this.value.toLowerCase();
                    const musicRows = document.querySelectorAll('#musicList tr');
                    let noMusicFound = true;

                    musicRows.forEach(row => {
                        const title = row.querySelector('td:nth-child(1)').textContent.toLowerCase();
                        const category = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                        const language = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
                        const isVisible = title.includes(searchTerm) || category.includes(searchTerm) || language.includes(searchTerm);

                        row.style.display = isVisible ? '' : 'none';

                        if (isVisible) {
                            noMusicFound = false;
                        }
                    });

                    // Show/hide no music found message
                    const noMusicFoundMessage = document.getElementById('noMusicFoundMessage');
                    noMusicFoundMessage.style.display = noMusicFound ? 'block' : 'none';
                });
            </script>
            <script>
                // JavaScript for tab switching
                const tabButtons = document.querySelectorAll('.tab-button');
                const musicRows = document.querySelectorAll('#musicList tr');
                const searchInput = document.getElementById('searchInput');
                const searchOverlay = document.getElementById('searchOverlay');

                // Add event listener for search input focus
                searchInput.addEventListener('focus', () => {
                    searchOverlay.classList.remove('hidden');
                });

                // Add event listener for search input blur
                searchInput.addEventListener('blur', () => {
                    searchOverlay.classList.add('hidden');
                });

                tabButtons.forEach(button => {
                    button.addEventListener('click', () => {
                        // Set active class on clicked tab button
                        tabButtons.forEach(btn => btn.classList.remove('active'));
                        button.classList.add('active');

                        // Show/hide rows based on selected tab
                        const tabName = button.id.slice(3).toLowerCase(); // Extract tab name (e.g., 'All', 'Songs', 'Playlist')
                        musicRows.forEach(row => {
                            const category = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                            const isSongRow = tabName === 'songs' && category !== 'playlist';
                            const isPlaylistRow = tabName === 'playlist' && category === 'playlist';
                            const isVisible = tabName === 'all' || isSongRow || isPlaylistRow;

                            row.style.display = isVisible ? '' : 'none';
                        });

                        // Show/hide no music found message
                        const noMusicFoundMessage = document.getElementById('noMusicFoundMessage');
                        const visibleRows = document.querySelectorAll('#musicList tr[style=""]');
                        noMusicFoundMessage.style.display = visibleRows.length > 0 ? 'none' : 'block';
                    });
                });
            </script>

</div>
            </div>
</x-app-layout>
