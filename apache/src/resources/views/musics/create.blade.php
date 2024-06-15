<head>
    <!-- Include CSS file in your Blade view -->
<link href="{{ asset('css/dropdown.css') }}" rel="stylesheet">


</head>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Hymn Management - Add') }}
        </h2>
        
    </x-slot>

    <div class="py-10 mt-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
     
                <!-- Add Music Form -->
                <form method="POST" action="{{ route('musics.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="flex flex-wrap">
    <div class="w-full md:w-1/3 px-4">
        <!-- Church Hymn -->
        <div class="mb-4 mt-4">
            <label for="church_hymn_id" class="block text-sm font-bold text-gray-700 mb-2">Church Hymn:</label>
            <select required id="church_hymn_id" name="church_hymn_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="" disabled selected>Select Church Hymn</option>
                @foreach($churchHymns as $churchHymn)
                    <option value="{{ $churchHymn->id }}">{{ $churchHymn->name }}</option>
                @endforeach
            </select>
        </div>
    </div>


    <div class="w-full md:w-1/3 px-4">
        <!-- Title -->
        <div class="mb-4 mt-4">
            <label for="add_title" class="block text-sm font-bold text-gray-700 mb-2">Title:</label>
            <input required type="text" id="add_title" name="add_title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
    </div>


    <div class="w-full md:w-1/3 px-4">
    <!-- Song Number -->
    <div class="mb-4 mt-4">
        <label for="song_number" class="block text-sm font-bold text-gray-700 mb-2">Hymn Number:</label>
        <input required type="number" id="song_number" name="song_number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" pattern="[0-9]*" inputmode="numeric" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
    </div>
</div>

</div>


                    <div class="flex flex-wrap">
                        <!-- File Inputs -->
                     
                            <!-- Left Column -->
                            <div class="w-full md:w-1/2 px-4">
                                
                                <div class="mb-4">
                                    <label for="vocals_mp3_path" class="block text-sm font-bold text-gray-700 mb-2">Vocals:</label>
                                    <input type="file" id="vocals_mp3_path" name="vocals_mp3_path" class="mb-2 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" accept="audio/mpeg, audio/mp3">
                                </div>
                                <div class="mb-4">
                                    <label for="organ_mp3_path" class="block text-sm font-bold text-gray-700 mb-2">Organ:</label>
                                    <input type="file" id="organ_mp3_path" name="organ_mp3_path" class="mb-2 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" accept="audio/mpeg, audio/mp3">
                                </div>
                                <div class="mb-4">
                                    <label for="preludes_mp3_path" class="block text-sm font-bold text-gray-700 mb-2">Preludes:</label>
                                    <input type="file" id="preludes_mp3_path" name="preludes_mp3_path" class="mb-2 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" accept="audio/mpeg, audio/mp3">
                                </div>
                            </div>

                            <!-- Right Column -->
                            <div class="w-full md:w-1/2 px-4">
                                <div class="mb-4">
                                    <label for="music_score_path" class="block text-sm font-bold text-gray-700 mb-2">Music Score:</label>
                                    <input type="file" id="music_score_path" name="music_score_path" class="mb-2 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" accept=".pdf">
                                </div>
                                <div class="mb-4">
                                    <label for="lyrics_path" class="block text-sm font-bold text-gray-700 mb-2">Lyrics:</label>
                                    <input type="file" id="lyrics_path" name="lyrics_path" class="mb-2 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" accept=".pdf">
                                </div>
                            </div>
                        </div>
                    


                    <div class="flex flex-wrap">

                    <!-- Hidden input fields to store selected IDs -->
<input type="hidden" id="selected_category_ids" name="category_id[]" value="">
<input type="hidden" id="selected_instrumentation_ids" name="instrumentation_id[]" value="">
<input type="hidden" id="selected_ensemble_type_ids" name="ensembletype_id[]" value="">
<!-- Add more hidden inputs for other dropdowns as needed -->


        <!-- Left Column -->
        <div class="w-full md:w-1/2 px-4">

                            <!-- Category -->
                            <div class="mb-4">
                                <label for="category_id" class="block text-sm font-bold text-gray-700 mb-2">Category:</label>
                                <div class="combo-box">
                                    <div class="input-container" onclick="toggleDropdown('category')">
                                        <div id="category_id" name="category_id" class="selected-items"><!-- Selected categoies will appear here --></div>
                                        <input type="text" id="category-input" placeholder="Select categories...">
                                        <div class="dropdown-arrow"></div>
                                    </div>
                                    <div id="category-options-container" class="options-container">
                                        <!-- Category options are populated by JavaScript -->
                                        @foreach($categories as $category)
                                            <div class="option-item">
                                                <label>
                                                    <input type="checkbox" value="{{ $category->id }}" onclick="handleDropdownSelection(this, 'category_id', 'selected_category_ids')">

                                                    {{ $category->name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <!-- Instrumentation-->
                            <div class="mb-4">
                                <label for="instrumentation_id" class="block text-sm font-bold text-gray-700 mb-2">Instrumentation:</label>
                                <div class="combo-box">
                                    <div class="input-container" onclick="toggleDropdown('instrumentation')">
                                        <div id="instrumentation_id" name="instrumentation_id" class="selected-items"><!-- Selected categoies will appear here --></div>
                                        <input type="text" id="instrumentation-input" placeholder="Select instrumentations...">
                                        <div class="dropdown-arrow"></div>
                                    </div>
                                    <div id="instrumentation-options-container" class="options-container">
                                        <!-- Instrumentation options are populated by JavaScript -->
                                        @foreach($instrumentations as $instrumentation)
                                            <div class="option-item">
                                                <label>
                                                    <input type="checkbox" value="{{ $instrumentation->id }}" onclick="handleDropdownSelection(this, 'instrumentation_id', 'selected_instrumentation_ids')">
                                                 
                                                    {{ $instrumentation->name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <!-- Ensemble Type -->
                            <div class="mb-4">
                                <label for="ensemble_type_id" class="block text-sm font-bold text-gray-700 mb-2">Ensemble Type:</label>
                                <div class="combo-box">
                                    <div class="input-container" onclick="toggleDropdown('ensemble_type')">
                                        <div id="ensemble_type_id" name="ensemble_type_id" class="selected-items"><!-- Selected categoies will appear here --></div>
                                        <input type="text" id="ensemble_type-input" placeholder="Select ensembleTypes...">
                                        <div class="dropdown-arrow"></div>
                                    </div>
                                    <div id="ensemble_type-options-container" class="options-container">
                                        <!-- Ensemble_type options are populated by JavaScript -->
                                        @foreach($ensembleTypes as $ensembleType)
                                            <div class="option-item">
                                                <label>
                                                    <input type="checkbox" value="{{ $ensembleType->id }}" onclick="handleDropdownSelection(this, 'ensemble_type_id', 'selected_ensemble_type_ids')">
                                                    {{ $ensembleType->name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>


                            
                    <!-- Hidden input fields to store selected IDs -->
<input type="hidden" id="selected_lyricist_ids" name="lyricist_id[]" value="">
<input type="hidden" id="selected_composer_ids" name="composer_id[]" value="">
<input type="hidden" id="selected_arranger_ids" name="arranger_id[]" value="">

                            <!-- Lyricist Dropdown -->
                            <div class="mb-4">
                                <label for="lyricist_id" class="block text-sm font-bold text-gray-700 mb-2">Lyricist:</label>
                                <div class="combo-box">
                                    <div class="input-container" onclick="toggleDropdown('lyricist')">
                                        <div id="lyricist_id" name="lyricist_id" class="selected-items"><!-- Selected lyricists will appear here --></div>
                                        <input type="text" id="lyricist-input" placeholder="Select lyricists...">
                                        <div class="dropdown-arrow"></div>
                                    </div>
                                    <div id="lyricist-options-container" class="options-container">
                                        <!-- Lyricist options are populated by JavaScript -->
                                        @foreach($creators as $creator)
                                            <div class="option-item">
                                                <label>
                                                    <input type="checkbox" value="{{ $creator->id }}" onclick="handleDropdownSelection(this, 'lyricist_id', 'selected_lyricist_ids')">
                                                    {{ $creator->name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
        </div>

<!-- Right Column -->
<div class="w-full md:w-1/2 px-4">

<!-- Composer Dropdown -->
<div class="mb-4">
    <label for="composer_id" class="block text-sm font-bold text-gray-700 mb-2">Composer:</label>
    <div class="combo-box">
        <div class="input-container" onclick="toggleDropdown('composer')">
            <div id="composer_id" name="composer_id" class="selected-items"><!-- Selected composers will appear here --></div>
            <input type="text" id="composer-input" placeholder="Select composers...">
            <div class="dropdown-arrow"></div>
        </div>
        <div id="composer-options-container" class="options-container">
            <!-- Composer options are populated by JavaScript -->
            @foreach($creators as $creator)
                <div class="option-item">
                    <label>
                        
                        <input type="checkbox" value="{{ $creator->id }}" onclick="handleDropdownSelection(this, 'composer_id', 'selected_composer_ids')">
                        {{ $creator->name }}
                    </label>
                </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Arranger Dropdown -->
<div class="mb-4">
    <label for="arranger_id" class="block text-sm font-bold text-gray-700 mb-2">Arranger:</label>
    <div class="combo-box">
        <div class="input-container" onclick="toggleDropdown('arranger')">
            <div id="arranger_id" name="arranger_id" class="selected-items"><!-- Selected arrangers will appear here --></div>
            <input type="text" id="arranger-input" placeholder="Select arrangers...">
            <div class="dropdown-arrow"></div>
        </div>
        <div id="arranger-options-container" class="options-container">
            <!-- Arranger options are populated by JavaScript -->
            @foreach($creators as $creator)
                <div class="option-item">
                    <label>
                        
                        <input type="checkbox" value="{{ $creator->id }}" onclick="handleDropdownSelection(this, 'arranger_id', 'selected_arranger_ids')">
                        {{ $creator->name }}
                    </label>
                </div>
            @endforeach
        </div>
    </div>
</div>





                    <!-- Language Dropdown-->
                    <div class="mb-4">
                        <label for="language_id" class="block text-sm font-bold text-gray-700 mb-2">Language:</label>
                        <select required id="language_id" name="language_id"  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="" disabled selected>Select Language</option>   
                            @foreach($languages as $language)
                                <option value="{{ $language->id }}">{{ $language->name }}</option>
                            @endforeach
                        </select>
                    </div>

<!-- Verses Used -->
<div class="mb-4">
    <label for="versesused" class="block text-sm font-bold text-gray-700 mb-2">Reference Verses:</label>
    <textarea id="versesused" name="versesused" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" style="width: 400px;"></textarea>
</div>



</div>

</div>


                <!-- Buttons to submit or close modal -->
                    <div class="flex justify-end">
                        <button type="submit" class="btn btn-primary">
                            Add
                        </button>
                        <button type="button" class="bg-gray-600 hover:bg-gray-800 text-black font-bold py-2 px-4 rounded ml-2 focus:outline-none focus:shadow-outline" onclick="closeAddMusicModal()">
                            Cancel
                        </button>
                    </div>

            
                    <script>
                        // Function to close the modal and redirect to the music page
                        function closeAddMusicModal() {
                            // Add your redirection logic here
                            window.location.href = '/musics'; // Replace '/music' with the URL of your music page
                        }
                    </script>

                </form>
            </div>
        </div>
    </div>
    </div>

</x-app-layout>

<script>
  // Generic object to manage selected items
let selectedDropdownItems = {};

// Function to toggle dropdown visibility
function toggleDropdown(dropdownId) {
    let dropdownOptionsContainer = document.getElementById(`${dropdownId}-options-container`);
    dropdownOptionsContainer.classList.toggle("active");
}

// Function to handle item selection in a dropdown
// function handleDropdownSelection(checkbox, selectedContainerId) {
//     let selectedContainer = document.getElementById(selectedContainerId);

//     // Check if the checkbox is checked
//     if (checkbox.checked) {
//         // Append the selected item to the selectedContainer
//         appendSelectedItem(selectedContainer, checkbox);
//     } else {
//         // Remove the item from the selectedContainer
//         removeSelectedItem(selectedContainer, checkbox);
//     }
// }



function handleDropdownSelection(checkbox, selectedContainerId, hiddenInputId) {
    let selectedContainer = document.getElementById(selectedContainerId);
    let hiddenInput = document.getElementById(hiddenInputId);

    // Check if the checkbox is checked
    if (checkbox.checked) {
        // Append the selected item to the selectedContainer
        appendSelectedItem(selectedContainer, checkbox);

        // Update hidden input value with selected ID
        hiddenInput.value += checkbox.value + ',';
    } else {
        // Remove the item from the selectedContainer
        removeSelectedItem(selectedContainer, checkbox);

        // Remove ID from hidden input value
        let regex = new RegExp(checkbox.value + ',', 'g');
        hiddenInput.value = hiddenInput.value.replace(regex, '');
    }
}



// Function to append a selected item to the selected items container
function appendSelectedItem(selectedContainer, checkbox) {
    let itemName = checkbox.parentNode.textContent.trim();

    let selectedItem = document.createElement("div");
    selectedItem.className = "selected-tag";
    selectedItem.textContent = itemName;

    let removeButton = document.createElement("span");
    removeButton.textContent = "×";
    removeButton.onclick = function () {
        // Uncheck the corresponding checkbox
        checkbox.checked = false;
        // Remove the selected item element
        selectedItem.remove();
    };

    selectedItem.appendChild(removeButton);
    selectedContainer.appendChild(selectedItem);
}

// Function to remove a selected item from the selected items container
function removeSelectedItem(selectedContainer, checkbox) {
    Array.from(selectedContainer.children).forEach((tag) => {
        // Get the text content of the selected item and remove unwanted characters
        let tagText = tag.textContent.trim().replace(/×/g, "");

        // Get the text content of the checkbox's parent node and remove unwanted characters
        let checkboxText = checkbox.parentNode.textContent.trim().replace(/×/g, "");

        // Check if the cleaned text content matches between the selected item and checkbox
        if (tagText === checkboxText) {
            // Remove the selected item element
            tag.remove();
        }
    });
}

// Function to filter options in a dropdown
function filterDropdownOptions(inputId, optionsContainerId) {
    const input = document.getElementById(inputId).value.trim().toUpperCase();
    const optionsContainer = document.getElementById(optionsContainerId);
    const optionItems = optionsContainer.querySelectorAll(".option-item");

    optionItems.forEach((item) => {
        const text = item.textContent.trim().toUpperCase();
        const checkbox = item.querySelector('input[type="checkbox"]');
        if (text.includes(input)) {
            item.style.display = "";
            if (checkbox) {
                checkbox.style.display = "inline-block";
            }
        } else {
            item.style.display = "none";
            if (checkbox) {
                checkbox.style.display = "none";
            }
        }
    });
}

// Attach event listeners for document click and input change
document.addEventListener("click", function (event) {
    // Hide dropdowns when clicking outside of the input containers and options containers
    const allComboBoxes = document.querySelectorAll(".combo-box");
    allComboBoxes.forEach((comboBox) => {
        const inputContainer = comboBox.querySelector(".input-container");
        const optionsContainer = comboBox.querySelector(".options-container");
        if (!inputContainer.contains(event.target) && !optionsContainer.contains(event.target)) {
            optionsContainer.classList.remove("active");
        }
    });
});

// Function to attach input event listeners for filtering options
function attachFilterListeners(inputId, optionsContainerId) {
    const inputElement = document.getElementById(inputId);
    inputElement.addEventListener("input", function () {
        filterDropdownOptions(inputId, optionsContainerId);
        toggleDropdown(inputId.replace("-input", "")); // Open dropdown if not already open
    });
}

// Initialize filter listeners for each dropdown
attachFilterListeners("lyricist-input", "lyricist-options-container");
attachFilterListeners("composer-input", "composer-options-container");
attachFilterListeners("arranger-input", "arranger-options-container");

</script>